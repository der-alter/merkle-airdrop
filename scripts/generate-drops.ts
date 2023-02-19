import fs from "fs";
import { generateKeys, generateMnemonic } from "sotez";

const between = (min: number, max: number) =>
    Math.floor(Math.random() * (max - min) + min);

const NB_KEYS = 200;
const MIX_AMOUNT = 1;
const MAX_AMOUNT = 200;
const TESTDATA_FILEPATH = "../contracts/web/tests/testdata/drops.json";
const PHP_FIXTURES_FILEPATH = "../app/fixtures/grantee.json"

function* makeKeys() {
    for (let i = 0; i <= NB_KEYS; i++) {
        yield generateKeys(generateMnemonic());
    }
}

// generate test data, both for contract integration tests and php app
const generate = async () => {
    const keys = makeKeys();
    const drops = [];

    for (const key of keys) {
        const amount = between(MIX_AMOUNT, MAX_AMOUNT);
        drops.push({ ...(await key), amount });
    }

    fs.writeFileSync(TESTDATA_FILEPATH, JSON.stringify(drops));
    const phpFixtures: { [k: string]: any } = { "App\\Entity\\Grantee": {} };

    drops.forEach((drop, i) => {
        phpFixtures["App\\Entity\\Grantee"][`grantee${i}`] = {
            address: drop.pkh,
            amount: drop.amount,
            airdrop: "@airdrop_1",
        };
    });
    fs.writeFileSync(PHP_FIXTURES_FILEPATH, JSON.stringify(phpFixtures));
};

generate();
