<template>
    <div class="container-fluid">
        <div class="d-flex flex-row flex-nowrap">

                <draggable v-model="orders_noNew" :options="{animation:200, group:'date'}" class="row" @change="update($event)">
                    <div v-for="order in orders_noNew" :key="order.order_ID" :data-id="order.order_ID" class="card mb-2 mr-2">
                        <div class="card-body">
                            <a :href="'/orders/' + order.order_ID + ''">PW-{{order.order_NAME}}</a>
                            <p class="card-text">{{order.order_CLIENT_NAME}} {{order.order_CLIENT_SURNAME}}</p>
                        </div>
                        <div class="card-footer text-muted">
                            Planowany czas: {{order.order_pp_PEDIOD}} godz
                        </div>
                    </div>
                </draggable>   
           
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    import moment from 'moment'
    Vue.prototype.moment = moment
    moment.locale('pl')

    export default {
        components:{
            draggable
        },
        props: ['orders_no'],

        data() {
            return {
                orders_noNew: this.orders_no,
            }
        },
        methods: {
            update(event) {
                console.log(event.added.element.order_ID)
                let id = event.added.element.order_ID;
                axios.patch('/planplastykow/' + id,{
                    order_pp_ID: 0
                }).then((response) => {
                    // OK
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
