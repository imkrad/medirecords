<template>
     <div class="row">
        <BCol lg="4">
            <div class="row">
                <BCol lg="12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-success fw-semibold mb-0">{{appointment.service.name}}</h5>
                        </div>
                        <div class="card-body" style="height: calc((100vh - 420px) / 2); overflow: auto;">
                           
                        </div>
                    </div>
                </BCol>
                <BCol lg="12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-success fw-semibold mb-0">{{appointment.service.name}}</h5>
                        </div>
                        <div class="card-body" style="height: calc((100vh - 420px) / 2); overflow: auto;">
                           
                        </div>
                    </div>
                </BCol>
            </div>
        </BCol>
        <BCol lg="8">
            <div class="row">
                <BCol lg="12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-success fw-semibold mb-0">Checkups</h5>
                        </div>
                        <div class="card-body" style="height: calc((100vh - 420px) / 2); overflow: auto;">
                           
                        </div>
                    </div>
                </BCol>
                <BCol lg="12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <h5 class="card-title text-success fw-semibold mb-0 flex-grow-1">Delivery</h5>
                            <div class="flex-shrink-0">
                                <button @click="openDelivery()" type="button" class="btn btn-soft-primary btn-sm material-shadow-none mt-n2 mb-n2">
                                    Add Delivery
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="height: calc((100vh - 420px) / 2); overflow: auto;">
                           
                        </div>
                    </div>
                </BCol>
            </div>
        </BCol>
    </div>
    <Delivery :dropdowns="dropdowns" ref="delivery"/>
</template>
<script>
import Delivery from '../Modals/Delivery.vue';
export default {
    components: { Delivery },
    props:['a','appointment','dropdowns'],
    data(){
        return {

        }
    },
    methods: {
        openDelivery(){
            this.$refs.delivery.show();
        }
    }
}
</script>