<template>
    <tr>
        <router-link :to="itemLink" tag="td">
            <h5 class="blue-grey-700 mt-0">{{ gateway.name }}</h5>
            <span class="badge badge-info">{{ gateway.ip }}</span>

            <div v-if="gateway.description">
                <small class="blue-grey-400">{{ gateway.description }}</small>
            </div>
        </router-link>
        <td class="cell-60">
            <button class="btn btn-sm btn-icon btn-danger" @click="destroy">
                <icon name="far fa-trash-alt"></icon>
            </button>
        </td>
    </tr>
</template>

<script>
    import Repository from 'Repositories/Xiaomi';
    import {XIAOMI_GATEWAY_SHOW} from 'router/actions';

    export default {
        props: {
            gateway: {
                required: true,
                type: Object,
                default() {
                    return Repository.gatewayStructure;
                }
            }
        },
        methods: {
            async destroy() {
                this.$emit('destroy', this.gateway)
            }
        },
        computed: {
            itemLink() {
                return {
                    name: XIAOMI_GATEWAY_SHOW,
                    params: {id: this.gateway.id}
                }
            }
        }
    }
</script>