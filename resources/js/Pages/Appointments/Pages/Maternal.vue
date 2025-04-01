<template>
        <BCol lg="12">
            <table class="table table-bordered table-nowrap align-middle mb-0 mt-2">
                <thead class="bg-primary text-white">
                    <tr class="fs-10">
                        <th class="text-center" colspan="3">Prenatal Check-ups</th>
                        <th class="text-center" colspan="6">Immunization Status</th>
                        <th class="text-center" colspan="8">Micronutrient Supplementation</th>
                        <th class="text-center">Nutritional Assessment</th>
                        <th class="text-center">Deworming Tablet</th>
                        <th class="text-center" colspan="3">Infectious Disease Surveillance</th>
                        <th class="text-center" colspan="2">Laboratory Screening</th>
                    </tr>
                    <tr class="fs-10">
                        <th class="text-center align-middle" rowspan="2">1st Tri</th>
                        <th class="text-center align-middle" rowspan="2">2nd Tri</th>
                        <th class="text-center align-middle" rowspan="2">3rd Tri</th>
                        <th class="text-center" colspan="5">Tetanus Diphtheria/Toxoid</th>
                        <th class="text-center">FIM</th>
                        <th class="text-center" colspan="4">Iron Sulfate</th>
                        <th class="text-center" colspan="3">Calcium Carbonate</th>
                        <th class="text-center">Iodine Capsules</th>
                        <th class="text-center align-middle" rowspan="2">-</th>
                        <th class="text-center align-middle" rowspan="2">-</th>
                        <th class="text-center align-middle" rowspan="2">Screening</th>
                        <th class="text-center align-middle" rowspan="2">Hepatitis B</th>
                        <th class="text-center align-middle" rowspan="2">HIV</th>
                        <th class="text-center align-middle" rowspan="2">Gestational Diabetes</th>
                        <th class="text-center align-middle" rowspan="2">CBC/HGB/HCT</th>
                    </tr>
                    <tr class="fs-10">
                        <th class="text-center">1</th>
                        <th class="text-center">2</th>
                        <th class="text-center">3</th>
                        <th class="text-center">4</th>
                        <th class="text-center">5</th>
                        <th class="text-center">-</th>
                        <th class="text-center">1st Tri</th>
                        <th class="text-center">2nd Tri</th>
                        <th class="text-center">3rd Tri</th>
                        <th class="text-center">4th Tri</th>
                        <th class="text-center">2nd Tri</th>
                        <th class="text-center">3rd Tri</th>
                        <th class="text-center">4th Tri</th>
                        <th class="text-center">1st Tri</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <tr>
                        <td class="text-center" v-for="(list,index) in results" v-bind:key="index" style="cursor: pointer;" @click="openView(list)">
                            <i v-if="list.length > 0" class="text-success fs-16 ri-checkbox-circle-fill"></i>
                            <i v-else class="text-danger fs-16 ri-close-circle-line"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </BCol>
        <BCol lg="4">
            <div class="table-responsive mt-4">
                <simplebar style="height: 400px;">
                <table class="table table-nowrap table-bordered table-striped align-middle mb-0">
                    <thead class="bg-primary text-white thead-fixed">
                        <tr class="fs-13 fw-bold">
                            <th colspan="2">Prenatal Details</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white fs-12">
                        <tr>
                            <td class="text-center">Code</td>
                            <td class="text-center">{{appointment.code}}</td>
                        </tr>
                        <tr>
                            <td class="text-center">Status</td>
                            <td class="text-center">{{appointment.status.name}}</td>
                        </tr>
                        <tr>
                            <td class="text-center">Registration Date</td>
                            <td class="text-center">{{appointment.registration_at}}</td>
                        </tr>
                        <tr>
                            <td class="text-center">Age</td>
                            <td class="text-center">{{appointment.age}}</td>
                        </tr>
                        <tr>
                            <td class="text-center">Last Menstrual Period</td>
                            <td class="text-center">{{appointment.maternal.lmp_at}}</td>
                        </tr>
                        <tr>
                            <td class="text-center">Last Menstrual Period</td>
                            <td class="text-center">{{appointment.maternal.edc_at}}</td>
                        </tr>
                        <tr>
                            <td class="text-center">Height</td>
                            <td class="text-center">{{appointment.maternal.height}}</td>
                        </tr>
                        <tr>
                            <td class="text-center">Weight</td>
                            <td class="text-center">{{appointment.maternal.weight}}</td>
                        </tr>
                        <tr>
                            <td class="text-center">Remarks</td>
                            <td class="text-center">{{ (appointment.remarks) ?  appointment.remarks : '-' }}</td>
                        </tr>
                    </tbody>
                </table></simplebar>
            </div>
        </BCol>
        <BCol lg="8">
            <div class="table-responsive mt-4">
                <simplebar style="height: 400px;">
                    <table class="table table-nowrap table-striped align-middle mb-0">
                    <thead class="bg-primary thead-fixed">
                        <tr class="fs-13 fw-bold text-white">
                            <th colspan="5">Check-ups</th>
                            <th class="text-end">
                                <button @click="openCheckup()" type="button" class="btn btn-light btn-sm material-shadow-none mt-n2 mb-n2">
                                    New Check-up
                                </button>
                            </th>
                        </tr>
                        <tr class="fs-10 bg-light">
                            <th style="width: 4%;"></th>
                            <th>Type</th>
                            <th style="width: 35%;" class="text-center">Subtype</th>
                            <th style="width: 15%;" class="text-center">Count</th>
                            <th style="width: 15%;" class="text-center">Value</th>
                            <th style="width: 15%;" class="text-center">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white fs-10">
                        <tr v-for="(list,index) in a.data.maternal.checkups" v-bind:key="index" >
                            <td class="text-center">{{ index+1 }}</td>
                            <td>{{ list.type.name }}</td>
                            <td class="text-center">{{ (list.subtype) ? list.subtype.name : '-' }}</td>
                            <td class="text-center">{{ (list.count) ? list.count : '-' }}</td>
                            <td class="text-center">{{ (list.value) ? list.value : '-' }}</td>
                            <td class="text-center">{{ list.date_at }}</td>
                        </tr>
                    </tbody>
                </table>
                </simplebar>
            </div>
            <!-- <div class="row">
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
                                            <td class="text-center">{{ (list.subtype) ? list.subtype.name : '-' }}</td>
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
            </div> -->
        </BCol>
        <BCol lg="4">
            <div class="table-responsive mt-4">
                <simplebar style="height: 400px;">
                <table class="table table-nowrap table-bordered table-striped align-middle mb-0">
                    <thead class="bg-primary text-white thead-fixed">
                        <tr class="fs-13 fw-bold">
                            <th colspan="2">Additional Information</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white fs-12">
                        <tr>
                            <td class="text-center" style="width: 50%;">No. of Previous Pregnancy</td>
                            <td class="text-center" style="width: 50%;">{{ maternalInfo.previous_pregnancy }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">G <span class="fs-10 text-muted">(Prev + Curr)</span></td>
                            <td class="text-center">{{ maternalInfo.g }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">P <span class="fs-10 text-muted">(> 20 weeks pregnancy)</span></td>
                            <td class="text-center">{{ maternalInfo.p }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">A <span class="fs-10 text-muted">(Abortion)</span></td>
                            <td class="text-center">{{ maternalInfo.a }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">L <span class="fs-10 text-muted">(Living Child)</span></td>
                            <td class="text-center">{{ maternalInfo.l }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">Preterm</td>
                            <td class="text-center">{{ maternalInfo.preterm }}</td>
                        </tr>
                        <tr>
                            <td class="text-center">Fullterm</td>
                            <td class="text-center">{{ maternalInfo.fullterm }}</td>
                        </tr>
                    </tbody>
                </table></simplebar>
            </div>
        </BCol>
        <BCol lg="8">
            <div class="table-responsive mt-4">
                <simplebar style="height: 400px;">
                    <table class="table table-nowrap table-striped align-middle mb-0">
                    <thead class="bg-primary thead-fixed">
                        <tr class="fs-13 fw-bold text-white">
                            <th colspan="5">Delivery</th>
                            <th class="text-end">
                                <button @click="openDelivery()" type="button" class="btn btn-light btn-sm material-shadow-none mt-n2 mb-n2">
                                    Add Delivery
                                </button>
                            </th>
                        </tr>
                        <tr class="fs-10 bg-light">
                            <th>Name</th>
                            <th style="width: 15%;" class="text-center">Delivery</th>
                            <th style="width: 12%;" class="text-center">Outcome</th>
                            <th style="width: 15%;" class="text-center">Weight</th>
                            <th style="width: 17%;" class="text-center">Facility</th>
                            <th style="width: 12%;" class="text-center">Attendant</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white fs-10">
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
                </simplebar>
            </div>
            </BCol>
    <View ref="view"/>
    <Delivery :dropdowns="dropdowns" ref="delivery"/>
    <Checkup :dropdowns="dropdowns" ref="checkup"/>
</template>
<script>
import simplebar from "simplebar-vue";
import View from '../Modals/ViewCheckup.vue';
import Checkup from '../Modals/Checkup.vue';
import Delivery from '../Modals/Delivery.vue';
export default {
    components: { Delivery, Checkup, View, simplebar },
    props:['a','appointment','dropdowns','results'],
    data(){
        return {

        }
    },
    computed: {
        maternalInfo() {
            try {
                return typeof this.appointment.maternal.additional_info === "string"
                ? JSON.parse(this.appointment.maternal.additional_info)
                : this.appointment.maternal.additional_info;
            } catch (e) {
                return {}; // Return an empty object if parsing fails
            }
        },
    },
    methods: {
        openDelivery(){
            this.$refs.delivery.show(this.a.data.patient.member_id);
        },
        openCheckup(){
            this.$refs.checkup.show(this.a.data.maternal.id);
        },
        openView(data){
            this.$refs.view.show(data);
        }
    }
}
</script>
<style scoped>
.thead-fixed {
  position: sticky;
  top: 0;
  background-color: #fff; /* Set the background color for the fixed header */
  z-index: 1; /* Ensure the fixed header is above the scrolling content */
}
</style>