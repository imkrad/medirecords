<template>
    <Head title="Families" />
    <PageHeader title="List of Families" pageTitle="Lists" />
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Family Number</h4>
            <div class="flex-shrink-0">
                <!-- <button @click="openCreate" class="btn btn-soft-info btn-sm" type="button">
                    <div class="btn-content"><i class="ri-user-line align-middle"></i> Create User </div>
                </button> -->
            </div>
        </div>
        <div class="card-body" style="height: calc(100vh - 280px); overflow: auto;">
            <div class="table-responsive table-card">
                <table class="table align-middle table-centered mb-0">
                    <thead class="table-light thead-fixed">
                        <tr class="fs-11">
                            <th></th>
                            <th style="width: 30%;">Code</th>
                            <th style="width: 15%;" class="text-center">Name</th>
                            <th style="width: 15%;" class="text-center">Member</th>
                            <th style="width: 15%;" class="text-center">Date Created</th>
                            <th style="width: 15%;" class="text-center">Date Updated</th>
                            <th style="width: 7%;" ></th>
                        </tr>
                    </thead>
                    <tbody class="table-white">
                        <tr v-for="(list,index) in lists" v-bind:key="index">
                            <td class="text-center"> 
                                {{ (meta.current_page - 1) * meta.per_page + index + 1 }}.
                            </td>
                            <td>
                                <h5 class="fs-13 mb-0 text-dark">{{list.code}}</h5>
                            </td>
                            <td class="text-center fs-12">{{list.name}}</td>
                            <td class="text-center fs-12">{{list.members.length}}</td>
                            <td class="text-center fs-12">{{list.created_at}}</td>
                            <td class="text-center fs-12">{{list.updated_at}}</td>
                            <td class="text-end">
                                <b-button @click="openView(list)" variant="soft-info" class="me-1" v-b-tooltip.hover title="View" size="sm">
                                    <i class="ri-eye-fill align-bottom"></i>
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
    <View ref="view"/>
</template>
<script>
import _ from 'lodash';
import View from './View.vue';
import PageHeader from '@/Shared/Components/PageHeader.vue';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination, PageHeader, View }, 
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
            page_url = page_url || '/families';
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
        openView(data){
            this.$refs.view.show(data);
        }
    }
   
}
</script>