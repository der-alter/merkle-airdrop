import { DAppClient } from '@airgap/beacon-sdk';
import { createMessagePayload, signIn } from '@siwt/sdk'

export default () => ({
    error: false,

    async login(csrfToken) {
        const dAppClient = new DAppClient({ name: 'airdrop.pezos.fi' });
        try {
            // request wallet permissions with Beacon dAppClient
            const walletPermissions = await dAppClient.requestPermissions();

            // create the message to be signed
            const messagePayload = createMessagePayload({
                dappUrl: 'airdrop.pezos.fi',
                pkh: walletPermissions.address,
            });

            // request the signature
            const signedPayload = await dAppClient.requestSignPayload(messagePayload)

            // sign in the user to our app
            const { status, data } = await signIn('/')({
                pk: walletPermissions.accountInfo.publicKey,
                pkh: walletPermissions.address,
                message: messagePayload.payload,
                signature: signedPayload.signature,
                _csrfToken: csrfToken,
            })
            if (200 === status) {
                window.location.replace('/');
            }
            this.error = data.error;
        } catch (error) {
            const { statusText } = error.response;
            this.error = statusText;
        }
    }
})
