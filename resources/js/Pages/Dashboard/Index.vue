<template>
    <Head title="Dashboard" />
    <PageHeader title="Dashboard" pageTitle="Page" />
    <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
        <div class="file-manager-content w-100 p-4 pb-0" style="height: calc(100vh - 180px); overflow: auto;" ref="box">
            <div class="row">
                sd
            </div>
        </div>
    </div>
</template>
<script>
import _ from 'lodash';
import PageHeader from '@/Shared/Components/PageHeader.vue';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination, PageHeader }, 
    data(){
        return {
            currentUrl: window.location.origin,
            lists: [],
            meta: {},
            links: {},
            index: null,
            filter: {
                keyword: null,
                status: null,
                sortby: 'Created At',
                sort: 'desc'
            },
            index: null,
        }
    },
    watch: {
        "filter.keyword"(newVal){
            this.checkSearchStr(newVal)
        }
    },
    created(){
       
    },
    methods: {

    }
}
</script>