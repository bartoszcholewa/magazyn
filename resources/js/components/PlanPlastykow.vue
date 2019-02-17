<template>
    <div class="container-fluid raport mb-2">
        <div class="d-flex flex-row flex-nowrap">
            <div v-for="(pp, index1) in ppsNew" :key="index1" class="col-2" style="padding:1px;font-size:0.7vw;">
                <div class="card border-success">
                    <div class="card-header text-white bg-success">
                        <div class="row">
                            <div class="col">
                                <p class="text-center"> {{pp.pp_DATE}} - {{moment(pp.pp_DATE).format('dddd')}} </p>
                            </div>
                        </div>
                    </div>

                    <draggable v-model="pp.orders" :options="{animation:200, group:'date'}" class="card-body"  @change="update(index1, pp.pp_ID)">
                        <div v-for="(order, index2) in pp.orders" :key="index2" :data-id="order.order_ID" class="card mb-2">
                            <div class="card-body">
                                <a :href="'/orders/' + order.order_ID + ''">PW-{{order.order_NAME}}</a>
                                <p class="card-text">{{order.order_CLIENT_NAME}} {{order.order_CLIENT_SURNAME}}</p>
                            </div>
                            <div class="card-footer text-muted">
                                Planowany czas: {{order.order_pp_PERIOD}} godz
                            </div>
                        </div>
                    </draggable>               
                </div>
            </div>
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
        props: ['pps'],
        data() {
            return {
                ppsNew: this.pps,
            }
        },
        methods: {
            update(index1, id) {

                this.ppsNew[index1].orders.map((order, index2) => {
                    order.order_pp_ORDER = index2;
                    order.order_pp_ID = id;
                })
                axios.put('/planplastykow', {
                    orders: this.ppsNew[index1].orders
                }).then((response) =>{
                    console.log(this.ppsNew[index1].orders)
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
