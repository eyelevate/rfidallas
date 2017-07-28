<style scoped>
    .action-link {
        cursor: pointer;
    }

    .m-b-none {
        margin-bottom: 0;
    }
</style>

<template>
<div>
    <bootstrap-card use-header="true" use-body="true" use-footer="true">
        <template slot="header">
            Authorized Applications
        </template>
        <template slot="body">
            <div v-if="tokens.length > 0">
                <!-- Authorized Tokens -->
                <table class="table table-borderless m-b-none">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Scopes</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="token in tokens">
                            <!-- Client Name -->
                            <td style="vertical-align: middle;">
                                {{ token.client.name }}
                            </td>

                            <!-- Scopes -->
                            <td style="vertical-align: middle;">
                                <span v-if="token.scopes.length > 0">
                                    {{ token.scopes.join(', ') }}
                                </span>
                            </td>

                            <!-- Revoke Button -->
                            <td style="vertical-align: middle;">
                                <button class="btn btn-link btn-danger" @click="revoke(token)">
                                    Revoke
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </template>
        <template slot="footer">
            <a class="btn btn-secondary" href="/apis">Back</a>
        </template>
    </bootstrap-card>
</div>    
</template>

<script>
    export default {
        /*
         * The component's data.
         */
        data() {
            return {
                tokens: []
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component (Vue 2.x).
             */
            prepareComponent() {
                this.getTokens();
            },

            /**
             * Get all of the authorized tokens for the user.
             */
            getTokens() {
                axios.get('/oauth/tokens')
                        .then(response => {
                            this.tokens = response.data;
                        });
            },

            /**
             * Revoke the given token.
             */
            revoke(token) {
                axios.delete('/oauth/tokens/' + token.id)
                        .then(response => {
                            this.getTokens();
                        });
            }
        }
    }
</script>
