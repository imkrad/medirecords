<template>
    <Head title="Appointments" />
    <PageHeader title="Appointments" pageTitle="Lists" />
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Lists of Appointments</h4>
            <div class="flex-shrink-0">
                <button @click="openCreate" class="btn btn-primary btn-sm" type="button">
                    <div class="btn-content"><i class="ri-user-line align-middle"></i> Create Appointment </div>
                </button>
            </div>
        </div>
        <div class="card-body" style="height: calc(100vh - 290px); overflow: auto;">
            <div class="d-flex justify-content-sm-end gap-2" style="margin-bottom: 30px;">
                <div class="search-box" style="width: 60%;">
                    <input type="text" v-model="filter.keyword" class="form-control" placeholder="Search...">
                    <i class="ri-search-line search-icon"></i>
                </div>
                <select v-model="filter.service" class="form-control" style="width: 20%;">
                    <option :value="null">All Services</option>
                    <option v-for="(list,index) in services" v-bind:key="index" :value="list.value">{{list.name}}</option>
                </select>
                <select v-model="filter.status" class="form-control" style="width: 20%;">
                    <option :value="null">All Statuses</option>
                    <option v-for="(list,index) in statuses" v-bind:key="index" :value="list.value">{{list.name}}</option>
                </select>
            </div>
            <div class="table-responsive table-card" style=" height: calc(100vh - 545px)">
                <table class="table align-middle table-centered mb-0">
                    <thead class="table-light thead-fixed">
                        <tr class="fs-11">
                            <th style="width: 3%;"></th>
                            <th>Patient</th>
                            <th style="width: 15%;" class="text-center">Service</th>
                            <th style="width: 12%;" class="text-center">Registration Date</th>
                            <th style="width: 12%;" class="text-center">Status</th>
                            <th style="width: 12%;"></th>
                        </tr>
                    </thead>
                    <tbody class="table-white">
                        <tr v-for="(list,index) in lists" v-bind:key="index" >
                            <td class="text-center"> 
                                <div class="avatar-xs chat-user-img online">
                                    <img :src="'images/avatars/'+list.patient.member.avatar" alt="" class="avatar-xs rounded-circle">
                                </div>
                            </td>
                            <td>
                                <h5 class="fs-13 mb-0 fw-semibold text-primary text-uppercase">{{list.patient.member.lastname}}, {{list.patient.member.firstname}} {{list.patient.member.middlename}}.</h5>
                                <p class="fs-12 text-muted mb-0">{{list.patient.cellphone}}</p>
                            </td>
                            <td class="text-center">{{ list.service.name }}</td>
                            <td class="text-center">{{ list.registration_at }}</td>
                            <td class="text-center">
                                <span :class="'badge '+list.status.color">{{list.status.name}}</span>
                            </td>
                            <td class="text-end">
                                <Link :href="`/appointments/${list.id}`">
                                    <button type="button" class="btn btn-dark btn-sm bg-gradient waves-effect waves-light">View Appointment</button>
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <Create @update="fetch()" 
    :services="services" 
    :families="families" 
    :immunizations="immunizations"
    ref="create"/>
</template>
<script>
import _ from 'lodash';
import Create from './Create.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination, PageHeader, Create }, 
    props: ['services','families','immunizations','statuses'],
    data(){
        return {
            currentUrl: window.location.origin,
            lists: [],
            meta: {},
            links: {},
            filter: {
                keyword: null,
                service: null,
                status: null
            },
        }
    },
    watch: {
        "filter.keyword"(newVal){
            this.checkSearchStr(newVal)
        },
        "filter.service"(newVal){
            this.fetch();
        },
        "filter.status"(newVal){
            this.fetch();
        }
    },
    created(){
        this.fetch();
    },
    methods: {
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),
        fetch(page_url){
            page_url = page_url || '/appointments';
            axios.get(page_url,{
                params : {
                    keyword: this.filter.keyword,
                    service: this.filter.service,
                    status: this.filter.status,
                    option: 'lists',
                    count: 10
                }
            })
            .then(response => {
                if(response){
                    this.lists = response.data.data;
                    this.meta = response.data.meta;
                    this.links = response.data.links;          
                }
            })
            .catch(err => console.log(err));
        },
        openCreate(){
            this.$refs.create.show();
        }
    }
}
</script>