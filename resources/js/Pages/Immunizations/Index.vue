<template>
    <Head title="Users" />
    <PageHeader title="Immunizations" pageTitle="Lists" />
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Immunization Schedules</h4>
                    <div class="flex-shrink-0">

                    </div>
                </div>
                <div class="card-body" style="height: calc(100vh - 270px); overflow: auto;">
                    <div class="table-responsive table-card">
                        <table class="table align-middle table-centered mb-0">
                            <thead class="table-light thead-fixed">
                                <tr class="fs-11">
                                    <th>Name</th>
                                    <th style="width: 20%;" class="text-center">Dose</th>
                                    <th style="width: 20%;" class="text-center">Milestones</th>
                                </tr>
                            </thead>
                            <tbody class="table-white">
                                <tr v-for="(list,index) in immunizations" v-bind:key="index" >
                                    <td>
                                        <h5 class="fs-12 mb-0">{{list.vaccine.name}} <span class="text-primary fs-11">({{ list.vaccine.short }})</span></h5>
                                    </td>
                                    <td class="text-center fs-12">{{ formatOrdinal(list.dose) }}</td>
                                    <td class="text-center fs-12">{{ list.old }} {{ list.type }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Lists of Patients</h4>
                    <div class="flex-shrink-0">
                        <!-- <button class="btn btn-soft-info btn-sm" type="button">
                            <div class="btn-content"><i class="ri-file-list-3-line align-middle"></i> Generate Report </div>
                        </button> -->
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
        </div>
    </div>
</template>
<script>
import PageHeader from '@/Shared/Components/PageHeader.vue';
import Pagination from "@/Shared/Components/Pagination.vue";
export default {
    components: { Pagination, PageHeader }, 
    props: ['immunizations'],
    data(){
        return {
            currentUrl: window.location.origin,
        }
    },
    methods: { 
        formatOrdinal(n) {
            if (n === 1) return `${n}st`;
            if (n === 2) return `${n}nd`;
            if (n === 3) return `${n}rd`;
            return `${n}th`;
        }
    }
   
}
</script>