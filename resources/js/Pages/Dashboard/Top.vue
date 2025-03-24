<template>
    <div class="col-md-4" style="margin-bottom: -40px;" v-for="(item, index) of counts" :key="index"> 
        <div class="card shadow-none border">
            <div class="card-header bg-light-subtle">
                <div class="d-flex mb-n3">
                    <div class="flex-shrink-0 me-3">
                        <div style="height:2.5rem;width:2.5rem;">
                            <span class="avatar-title bg-primary-subtle rounded p-2 mt-n1">
                                <i :class="`${item.icon} text-primary fs-24`"></i>
                            </span>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="mb-0 fs-14">
                            <span class="text-body">{{item.total}}</span>
                        </h5>
                        <p class="text-muted text-truncate-two-lines fs-12">{{ item.name }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <apexchart class="apex-charts" height="40" width="100" type="area" dir="ltr" :series="item.series" :options="chartOptions"></apexchart>
                    </div>
                </div>
            </div>
            <div class="card-body  bg-white">
                <button @click="openSched(item.t)" class="btn btn-primary btn-sm bg-gradient float-end waves-effect waves-light mt-n1 mb-n1" type="button">
                    <div class="btn-content">View Schedules</div>
                </button>
                <p class="mb-0 text-primary fs-12 fw-semibold">{{ item.type }}</p>
            </div>
        </div>
    </div>
    <Schedule :visits="visits" :checkups="checkups" :immunizations="immunizations" ref="schedule"/>
</template>
<script>
import Schedule from './Schedule.vue';
export default {
    components : { Schedule },
    data(){
        return {
            currentUrl: window.location.origin,
            year: null,
            counts: [],
            visits: [],
            checkups: [],
            immunizations: [],
            chartOptions: {
                chart: { type: 'area', height: 40, sparkline: {enabled: true}},
                stroke: { curve: 'smooth', width: 2, },
                dataLabels: {  enabled: false },
                colors: ['#03114B'],
                fill: { type: 'gradient',gradient: {shadeIntensity: 1,inverseColors: false,opacityFrom: 0.45, opacityTo: 0.05,stops: [25, 100, 100, 100] }, },
                tooltip: { fixed: { enabled: false }, x: { show: true },marker: { show: false } }
            },
        }
    },
    created(){
        this.fetch();
        this.fetchSched();
    },
    methods: {
        fetch() {
            axios.get(this.currentUrl + '/insights',{
                params : {
                    option : 'tcl-top'
                }
            })
            .then(response => {
                this.counts = response.data;
            })
            .catch(err => console.log(err));
        },
        fetchSched() {
            axios.get(this.currentUrl + '/insights',{
                params : {
                    option : 'tcl-schedule'
                }
            })
            .then(response => {
                this.visits = response.data.visits;
                this.checkups = response.data.checkups;
                this.immunizations = response.data.immunizations;
            })
            .catch(err => console.log(err));
        },
        openSched(type){
            this.$refs.schedule.show(type);
        }
    }
}
</script>