let verify
  (proof : bytes list)
  (root : bytes)
  (leaf : bytes) =
  (List.fold
     (fun (acc, h: bytes * bytes) -> Crypto.sha256 (Bytes.concat h acc))
     proof
     leaf)
  = root
