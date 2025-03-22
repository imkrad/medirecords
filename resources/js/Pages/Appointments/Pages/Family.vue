<template>
    <div class="row">
        <BCol lg="4">
            <BCol lg="12">
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
            </BCol>
        </BCol>
        <BCol lg="8">
            <div class="card">
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
            </div>
        </BCol>
    </div>
    <Dropout :dropdowns="dropdowns" ref="dropout"/>
    <Visit ref="visit"/>
    <View ref="view"/>
    <Schedule ref="schedule"/>
</template>
<script>
import Dropout from '../Modals/Dropout.vue';
import Schedule from '../Modals/Schedule.vue';
import Visit from '../Modals/Visit.vue';
import View from '../Modals/View.vue';
export default {
    components: { Dropout, Schedule, Visit, View },
    props:['a','appointment','dropdowns'],
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
        }
    }
}
</script>