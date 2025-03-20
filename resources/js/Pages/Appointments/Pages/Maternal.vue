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
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0 mt-0">
                                    <tbody>
                                        <tr>
                                            <th class="ps-0" scope="row">Code :</th>
                                            <th class="text-primary">{{appointment.code}}</th>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Status :</th>
                                            <th class="text-primary">{{appointment.status.name}}</th>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Registration Date</th>
                                            <th class="text-primary">{{appointment.registration_at}}</th>
                                        </tr>
                                        <tr>
                                            <th class="ps-0" scope="row">Remarks</th>
                                            <td class="text-truncate" v-if="appointment.remarks">{{appointment.remarks}}</td>
                                            <th class="text-primary" v-else>-</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                        <div class="card-header d-flex">
                            <h5 class="card-title text-success fw-semibold mb-0 flex-grow-1">Check-ups</h5>
                            <div class="flex-shrink-0">
                                <button @click="openCheckup()" type="button" class="btn btn-soft-primary btn-sm material-shadow-none mt-n2 mb-n2">
                                    Add Check-up
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="height: calc((100vh - 420px) / 2); overflow: auto;">
                            <div class="table-responsive table-card">
                                <table class="table align-middle table-centered mb-0">
                                    <thead class="table-light thead-fixed">
                                        <tr class="fs-10">
                                            <th>Type</th>
                                            <th style="width: 35%;" class="text-center">Subtype</th>
                                            <th style="width: 15%;" class="text-center">Count</th>
                                            <th style="width: 15%;" class="text-center">Value</th>
                                            <th style="width: 15%;" class="text-center">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-white fs-10">
                                        <tr v-for="(list,index) in a.data.maternal.checkups" v-bind:key="index" >
                                            <td>{{ list.type.name }}</td>
                                            <td class="text-center">{{ list.subtype.name }}</td>
                                            <td class="text-center">{{ (list.count) ? list.count : '-' }}</td>
                                            <td class="text-center">{{ (list.value) ? list.value : '-' }}</td>
                                            <td class="text-center">{{ list.date_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                            <div class="table-responsive table-card">
                                <table class="table align-middle table-centered mb-0">
                                    <thead class="table-light thead-fixed">
                                        <tr class="fs-10">
                                            <th>Name</th>
                                            <th style="width: 15%;" class="text-center">Delivery</th>
                                            <th style="width: 12%;" class="text-center">Outcome</th>
                                            <th style="width: 15%;" class="text-center">Weight</th>
                                            <th style="width: 17%;" class="text-center">Facility</th>
                                            <th style="width: 12%;" class="text-center">Attendant</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-white fs-10">
                                        <tr v-for="(list,index) in a.data.maternal.deliveries" v-bind:key="index" >
                                            <td>
                                                <h5 class="fs-11 mb-0 fw-semibold text-uppercase" :class="(list.member.sex == 'Male') ? 'text-info' : 'text-danger'">{{list.member.lastname}}, {{list.member.firstname}} {{list.member.middlename}}.</h5>
                                                <p class="fs-10 text-muted mb-0">{{list.member.birthdate}} | </p>
                                            </td>
                                            <td class="text-center">{{ list.delivery.name }}</td>
                                            <td class="text-center">{{ list.outcome.name }}</td>
                                            <td class="text-center">{{ list.weight.name }}</td>
                                            <td class="text-center">{{ list.facility.name }}</td>
                                            <td class="text-center">{{ list.attendant.name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </BCol>
            </div>
        </BCol>
    </div>
    <Delivery :dropdowns="dropdowns" ref="delivery"/>
    <Checkup :dropdowns="dropdowns" ref="checkup"/>
</template>
<script>
import Checkup from '../Modals/Checkup.vue';
import Delivery from '../Modals/Delivery.vue';
export default {
    components: { Delivery, Checkup },
    props:['a','appointment','dropdowns'],
    data(){
        return {

        }
    },
    methods: {
        openDelivery(){
            this.$refs.delivery.show(this.a.data.patient.member_id);
        },
        openCheckup(){
            this.$refs.checkup.show(this.a.data.maternal.id);
        }
    }
}
</script>