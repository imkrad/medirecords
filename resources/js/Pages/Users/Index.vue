<template>
    <Head title="Users" />
    <PageHeader title="Users" pageTitle="Lists" />
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Lists of Users</h4>
            <div class="flex-shrink-0">
                <button @click="openCreate" class="btn btn-soft-info btn-sm" type="button">
                    <div class="btn-content"><i class="ri-user-line align-middle"></i> Create User </div>
                </button>
            </div>
        </div>
        <div class="card-body" style="height: calc(100vh - 280px); overflow: auto;">
            <div class="table-responsive table-card">
                <table class="table align-middle table-centered mb-0">
                    <thead class="table-light thead-fixed">
                        <tr class="fs-11">
                            <th></th>
                            <th style="width: 30%;">Name</th>
                            <th style="width: 15%;" class="text-center">Role</th>
                            <th style="width: 15%;" class="text-center">Email</th>
                            <th style="width: 15%;" class="text-center">Contact no.</th>
                            <th style="width: 15%;" class="text-center">Status</th>
                            <th style="width: 7%;" ></th>
                        </tr>
                    </thead>
                    <tbody class="table-white">
                        <tr v-for="(list,index) in lists" v-bind:key="index">
                            <td class="text-center"> 
                                {{ (meta.current_page - 1) * meta.per_page + index + 1 }}.
                            </td>
                            <td>
                                <h5 class="fs-13 mb-0 text-dark">{{list.lastname}}, {{list.firstname}} {{list.middlename[0]}}.</h5>
                            </td>
                            <td class="text-center fs-12">{{list.role}}</td>
                            <td class="text-center fs-12">{{list.email}}</td>
                            <td class="text-center fs-12">{{list.mobile}}</td>
                            <td class="text-center fs-12">
                                <span v-if="list.is_active" class="badge bg-success">Active</span>
                                <span v-else class="badge bg-danger">Inactive</span>
                            </td>
                            <td class="text-end">
                                <b-button @click="openView(list)" variant="soft-info" class="me-1" v-b-tooltip.hover title="View" size="sm">
                                    <i class="ri-eye-fill align-bottom"></i>
                                </b-button>
                                <b-button @click="openEdit(list,index)" variant="soft-warning" class="me-1" v-b-tooltip.hover title="Edit" size="sm">
                                    <i class="ri-pencil-fill align-bottom"></i>
                                </b-button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
        <div class="file-manager-content w-100 p-4 pb-0" style="height: calc(100vh - 180px); overflow: auto;" ref="box">
            <Lists :statuses="statuses"/>
        </div>
    </div> -->
    <Create @update="fetch()" ref="create"/>
</template>
<script>
import _ from 'lodash';
import Create from './Create.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination, PageHeader, Create }, 
    props: ['statuses'],
    data(){
        return {
            currentUrl: window.location.origin,
            lists: [],
            meta: {},
            links: {},
            filter: {
                keyword: null,
                status: null,
            },
            index: null
          
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
            page_url = page_url || '/users';
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
        },
        openEdit(data,index){
            this.index = index;
            this.$refs.create.edit(data);
        },
        openView(data){
            this.$refs.view.show(data);
        },
        updateData(data){
            this.lists[this.index] = data;
        }
    }
   
}
</script>