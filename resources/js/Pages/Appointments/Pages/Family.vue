<template>
    <BCol lg="12">
        <table class="table table-bordered table-nowrap align-middle mb-0 mt-2">
            <thead class="bg-primary text-white">
                <tr class="fs-10">
                    <th class="text-center" colspan="12">Follow-up Visits</th>
                    <th class="text-center" colspan="3">Deworming Drugs Given to 20-40 yrs old</th>
                    <th class="text-center align-middle" rowspan="2">Drop-out</th>
                </tr>
                <tr class="fs-10">
                    <th class="text-center align-middle" v-for="(list,index) in months" v-bind:key="index">{{list.name}}</th>
                    <th class="text-center align-middle">1st dose given</th>
                    <th class="text-center align-middle">2nd dose given</th>
                    <th class="text-center align-middle">3rd dose given</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr>
                    <td class="text-center" v-for="(list,index) in results" v-bind:key="index" :style="index > 12 ? 'cursor: pointer;' : ''" @click="handleClick(index, list)">
                        <i v-if="list" class="text-success fs-16 ri-checkbox-circle-fill"></i>
                        <i v-else class="text-danger fs-16 ri-close-circle-line"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </BCol>
    <BCol lg="4">
        <div class="table-responsive mt-4">
            <simplebar style="height: calc(100vh - 450px);">
            <table class="table table-nowrap table-bordered table-striped align-middle mb-0">
                <thead class="bg-primary text-white thead-fixed">
                    <tr class="fs-13 fw-bold">
                        <th colspan="2">Family Planning Details</th>
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
                        <td class="text-center">Method</td>
                        <td class="text-center">{{appointment.family.method.name}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">Type</td>
                        <td class="text-center">{{appointment.family.type.name}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">Height</td>
                        <td class="text-center">{{appointment.family.source}}</td>
                    </tr>
                    <tr>
                        <td class="text-center">Remarks</td>
                        <td class="text-center">{{ (appointment.remarks) ?  appointment.remarks : '-' }}</td>
                    </tr>
                </tbody>
            </table></simplebar>
        </div>
        <!-- <BCol lg="12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-success fw-semibold mb-0">{{appointment.service.name}}</h5>
                </div>
                <div class="card-body" style="height: calc((100vh - 190px) / 2); overflow: auto;">
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
                                    <th class="ps-0" scope="row">Age</th>
                                    <th class="text-primary">{{appointment.age}}</th>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Method :</th>
                                    <th class="text-primary">{{appointment.family.method.name}}</th>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Type :</th>
                                    <th class="text-primary">{{appointment.family.type.name}}</th>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Source :</th>
                                    <th class="text-primary">{{appointment.family.source}}
                                    </th>
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
                <div class="card-header d-flex">
                    <h5 class="card-title text-success fw-semibold mb-0 flex-grow-1">Dropout</h5>
                    <div class="flex-shrink-0">
                        <button v-if="appointment.family.is_dropout == 0" @click="openDropout" type="button" class="btn btn-soft-primary btn-sm material-shadow-none mt-n2 mb-n2">
                            Submit
                        </button>
                    </div>
                </div>
                <div class="card-body" style="height: calc((100vh - 650px) / 2);">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th class="ps-0" scope="row">Reason :</th>
                                    <th class="text-primary" v-if="a.data.family.reason_id">{{a.data.family.reason.name}}</th>
                                    <th class="text-primary" v-else>-</th>
                                </tr>
                                <tr>
                                    <th class="ps-0" scope="row">Date Dropout :</th>
                                    <th class="text-primary" v-if="a.data.family.dropout_at">{{a.data.family.dropout_at}}</th>
                                    <th class="text-primary" v-else>-</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </BCol> -->
    </BCol>
    <BCol lg="8">
        <div class="table-responsive mt-4">
            <simplebar style="height: calc(100vh - 450px);">
                <table class="table table-nowrap table-striped align-middle mb-0">
                <thead class="bg-primary thead-fixed">
                    <tr class="fs-13 fw-bold text-white">
                        <th colspan="6">Follow-ups Visits</th>
                    </tr>
                    <tr class="fs-10 bg-light">
                        <th style="width: 4%;">#</th>
                        <th>Month</th>
                        <th style="width: 20%;" class="text-center">Visited Date</th>
                        <th style="width: 20%;" class="text-center">Schedule Date</th>
                        <th style="width: 20%;" class="text-center">Status</th>
                        <th style="width: 15%;" class="text-center"></th>
                    </tr>
                </thead>
                <tbody class="bg-white fs-10">
                    <tr v-for="(list,index) in computedMonths" v-bind:key="index"
                    :class="{
                        'bg-success-subtle': list.visited_date != null && list.schedule_date != null,
                        'bg-warning-subtle': list.visited_date == null && list.schedule_date != null,
                    }">
                        <td>{{index+1}}</td>    
                        <td> 
                                {{ list.name }}
                            </td>
                            <td class="text-center">
                                {{ list.visited_date ? list.visited_date : '-' }}
                            </td>
                            <td class="text-center">
                                {{ list.schedule_date ? list.schedule_date : '-' }}
                            </td>
                            <td class="text-center">
                                <span v-if="list.visited_date" class="badge bg-success">Completed</span>
                                <span v-else class="badge bg-warning">Pending</span>
                            </td>
                            <td class="text-center">
                                <button v-if="!list.schedule_date" @click="openSchedule" type="button" class="btn btn-light btn-sm material-shadow-none mt-n2 mb-n2">
                                    Set Schedule
                                </button>
                                <button v-else-if="list.schedule_date && !list.visited_date" @click="openVisit(list.id)" type="button" class="btn btn-primary btn-sm material-shadow-none mt-n2 mb-n2">
                                    Mark Visit
                                </button>
                                <button v-else @click="openView(list)" type="button" class="btn btn-light btn-sm material-shadow-none mt-n2 mb-n2">
                                    View Visit
                                </button>
                            </td>
                        </tr>
                </tbody>
            </table>
            </simplebar>
        </div>
        <!-- <div class="card">
            <div class="card-header">
                <h5 class="card-title text-success fw-semibold mb-0">Follow-up Visits</h5>
            </div>
            <div class="card-body" style="height: calc(100vh - 345px); overflow: auto;">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0 mt-0">
                        <thead class="table-light thead-fixed">
                            <tr class="fs-10">
                                <th>Month</th>
                                <th style="width: 20%;" class="text-center">Visited Date</th>
                                <th style="width: 20%;" class="text-center">Schedule Date</th>
                                <th style="width: 20%;" class="text-center">Status</th>
                                <th style="width: 15%;" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody class="fs-11 table-white">
                            <tr v-for="(list,index) in computedMonths" v-bind:key="index" :class="(list.visited_date && list.schedule_date) ? 'bg-success-subtle' : ''">
                                <td> 
                                    {{ list.name }}
                                </td>
                                <td class="text-center">
                                    {{ list.visited_date ? list.visited_date : '-' }}
                                </td>
                                <td class="text-center">
                                    {{ list.schedule_date ? list.schedule_date : '-' }}
                                </td>
                                <td class="text-center">
                                    <span v-if="list.visited_date" class="badge bg-success">Completed</span>
                                    <span v-else class="badge bg-warning">Pending</span>
                                </td>
                                <td class="text-center">
                                    <button v-if="!list.schedule_date" @click="openSchedule" type="button" class="btn btn-light btn-sm material-shadow-none mt-n2 mb-n2">
                                        Set Schedule
                                    </button>
                                    <button v-else-if="list.schedule_date && !list.visited_date" @click="openVisit(list.id)" type="button" class="btn btn-primary btn-sm material-shadow-none mt-n2 mb-n2">
                                        Mark Visit
                                    </button>
                                    <button v-else @click="openView(list)" type="button" class="btn btn-light btn-sm material-shadow-none mt-n2 mb-n2">
                                        View Visit
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->
    </BCol>
    <Dropout :dropdowns="dropdowns" ref="dropout"/>
    <Visit ref="visit"/>
    <View ref="view"/>
    <Schedule ref="schedule"/>
    <Checkup :dropdowns="dropdowns" ref="checkup"/>
    <ViewF ref="viewf"/>
</template>
<script>
import Checkup from '../Modals/CheckupFamily.vue';
import simplebar from "simplebar-vue";
import Dropout from '../Modals/Dropout.vue';
import Schedule from '../Modals/Schedule.vue';
import Visit from '../Modals/Visit.vue';
import View from '../Modals/View.vue';
import ViewF from '../Modals/ViewF.vue';
export default {
    components: { Dropout, Schedule, Visit, View, simplebar, Checkup, ViewF },
    props:['a','appointment','dropdowns','results'],
    data(){
        return {
            months: [
                { name: "January", value: 1 },
                { name: "February", value: 2 },
                { name: "March", value: 3 },
                { name: "April", value: 4 },
                { name: "May", value: 5 },
                { name: "June", value: 6 },
                { name: "July", value: 7 },
                { name: "August", value: 8 },
                { name: "September", value: 9 },
                { name: "October", value: 10 },
                { name: "November", value: 11 },
                { name: "December", value: 12 },
            ],
        }
    },
    computed: {
        computedMonths() {
            return this.months.map((month) => {
                const visit = this.a?.data?.family?.visits?.find(
                    (v) => new Date(v.scheduled_at).getMonth() + 1 === month.value
                );

                return {
                    ...month,
                    id: visit ? visit.id : null,
                    visited_date: visit ? visit.visited_at : null,
                    schedule_date: visit ? visit.scheduled_at : null,
                    is_active: visit ? visit.is_active : false,
                    remarks: visit ? visit.remarks : '-',
                };
            });
        }
    },
    methods: {
        openDropout(){
            this.$refs.dropout.show(this.appointment.id);
        },
        openSchedule(){
            this.$refs.schedule.show(this.appointment.family.id);
        },
        openVisit(id){
            this.$refs.visit.show(id);
        },
        openView(id){
            this.$refs.view.show(id);
        },
        handleClick(index, value) {
            if (index > 12) {
                if(value){
                    this.$refs.viewf.show(value);
                }else{
                    let type = null;
                    if(index == 13){
                        type = '1st dose given';
                    }else if(index == 14){
                        type = '2nd dose given';
                    }else if(index == 15){
                        type = '3rd dose given';
                    }else{

                    }
                    this.$refs.checkup.show(type,this.a.data.family.id);
                }
            }
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