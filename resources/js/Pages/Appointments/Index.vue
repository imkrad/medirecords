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
        <div class="card-body" style="height: calc(100vh - 270px); overflow: auto;">
            <div class="table-responsive table-card" style=" height: calc(100vh - 545px)">
                <table class="table align-middle table-centered mb-0">
                    <thead class="table-light thead-fixed">
                        <tr class="fs-11">
                            <th style="width: 3%;"></th>
                            <th>Name</th>
                            <th style="width: 10%;" class="text-center">Sex</th>
                            <th style="width: 12%;" class="text-center">Marital</th>
                            <th style="width: 12%;" class="text-center">Birthday</th>
                            <th style="width: 12%;" class="text-center">Cellphone</th>
                            <th style="width: 15%;" class="text-center">Email</th>
                            <th style="width: 7%;"></th>
                        </tr>
                    </thead>
                    <tbody class="table-white">
                        <tr v-for="(list,index) in lists" v-bind:key="index" >
                            <td class="text-center"> 
                                <div class="avatar-xs chat-user-img online">
                                    <img :src="list.avatar" alt="" class="avatar-xs rounded-circle">
                                    <!-- <span v-if="list.is_active" class="user-status text-success"></span> -->
                                </div>
                            </td>
                            <td>
                                <h5 class="fs-13 mb-0 fw-semibold text-primary text-uppercase">{{list.lastname}}, {{list.firstname}} {{list.middlename}}.</h5>
                                <p class="fs-12 text-muted mb-0">{{list.address}}</p>
                            </td>
                            <td class="text-center">{{ list.sex }}</td>
                            <td class="text-center">{{ list.status }}</td>
                            <td class="text-center">{{ list.birthdate }}</td>
                            <td class="text-center">{{ list.cellphone }}</td>
                            <td class="text-center">{{ list.email }}</td>
                            <td>
                                <ul class="list-inline hstack gap-2 mb-0">
                                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Vie">
                                        <Link :href="`/patients/${list.code}`" class="text-primary d-inline-block edit-item-btn">
                                            <i class="ri-eye-fill fs-16"></i>
                                        </Link>
                                    </li>
                                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Remove">
                                        <a class="text-danger d-inline-block remove-item-btn" data-bs-toggle="modal" href="#deleteRecordModal">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <Create :services="services" ref="create"/>
</template>
<script>
import _ from 'lodash';
import Create from './Create.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination, PageHeader, Create }, 
    props: ['services'],
    data(){
        return {
            currentUrl: window.location.origin,
            lists: [],
            meta: {},
            links: {},
            filter: {
                keyword: null,
            },
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
            page_url = page_url || '/patients';
            axios.get(page_url,{
                params : {
                    keyword: this.filter.keyword,
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