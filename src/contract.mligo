#import "./constants.mligo" "Constants"
#import "./merkle_proof.mligo" "MerkleProof"
#import "./errors.mligo" "Errors"
#import "./storage.mligo" "Storage"
#import "./token.mligo" "Token"

type claim_params =
  [@layout:comb]
  {addr : address;
   amnt : nat;
   merkle_proof : bytes list}

type set_token_params = Token.t

type parameter = Claim of claim_params | Set_token of set_token_params

type storage = Storage.t

type result = operation list * storage

let claim (s : storage) (p : claim_params) =
  let {addr = addr;
       amnt = amnt;
       merkle_proof = merkle_proof} =
    p in
  let () = Storage.assert_not_claimed s addr in
  let leaf = MerkleProof.get_leaf (Bytes.pack (addr, amnt)) in
  let () =
    assert_with_error
      (not (MerkleProof.verify(merkle_proof, s.merkle_root, leaf)))
      Errors.invalid_proof in
  let claimed = Big_map.add addr unit s.claimed in
  [Token.transfer(s.token, addr, amnt)], {s with claimed}

let main (action, store : parameter * storage) =
  match action with
  Claim p -> claim store p
  | Set_token token -> Constants.no_operation, { store with token }

let generate_initial_storage
  (admin, token, about, merkle_root, claimed :
   address * Token.t * bytes * bytes * Storage.claimed) : storage =
  let metadata = (Big_map.empty : Storage.Metadata.t) in
  let metadata : Storage.Metadata.t =
    Big_map.update
      ("")
      (Some (Bytes.pack ("tezos-storage:content")))
      metadata in
  let metadata =
    Big_map.update ("content") (Some (about)) metadata in
  {admin; token; metadata; merkle_root; claimed}
