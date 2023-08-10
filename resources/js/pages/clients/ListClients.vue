<script setup>
import { onMounted, ref, computed } from 'vue';
import Swal from 'sweetalert2';
import axios from 'axios';

const selectedStatus = ref();
const clientStatus = ref([]);
const getClientStatus = () => {
    axios.get('/api/client-status')
        .then((response) => {
            clientStatus.value = response.data;
        })
};
const clients = ref([]);
const getClients = (status) => {
    selectedStatus.value = status;
    const params = {};
    if (status) {
        params.status = status;
    }
    axios.get('/api/clients', {
        params: params,
    })
        .then((response) => {
            clients.value = response.data;
        })
};

const clientsCount = computed(() => {
    return clientStatus.value.map(status => status.count).reduce((acc, value) => acc + value, 0);
});

const deleteAppointment = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/api/appointments/${id}`)
                .then((response) => {
                    appointments.value.data = appointments.value.data.filter(appointment => appointment.id !== id);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                });
        }
    })
};

onMounted(() => {
    getClients();
    getClientStatus();
});
</script>
<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Clients</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Appointments</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <router-link to="/admin/clients/create">
                                <button class="btn btn-primary" style="background-color: #ffc107; border:none;color:#333333;"><i class="fa fa-plus-circle mr-1"></i> Add New
                                    Client</button>
                            </router-link>
                        </div>
                        <div class="btn-group">
                            <button @click="getClients()" type="button" class="btn"
                                :class="[typeof selectedStatus === 'undefined' ? 'btn-warning' : 'btn-default']">
                                <span class="mr-1">All</span>
                                <span class="badge badge-pill badge-info" style="background-color: #333333!important;">{{ clientsCount }}</span>
                            </button>

                            <button v-for="status in clientStatus" @click="getClients(status.value)" type="button"
                                class="btn" :class="[selectedStatus === status.value ? 'btn-warning' : 'btn-default']">
                                <span class="mr-1">{{ status.name }}</span>
                                <span class="badge badge-pill" :class="`badge-${status.color}`" style="background-color: #333333!important;">{{ status.count }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(client, index) in clients.data" :key="client.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ client.first_name }} </td>
                                        <td>{{ client.last_name }}</td>
                                        <td>{{ client.email }}</td>
                                        <td>
                                            <span class="badge" :class="`badge-${client.status.color}`" style="background-color: #ffc107;">{{
                                                client.status.name }}</span>
                                        </td>
                                        <td>
                                            <router-link :to="`/admin/clients/${client.id}/edit`">
                                                <i class="fa fa-edit mr-2" style="color: #ffc107;"></i>
                                            </router-link>

                                            <a href="#" @click.prevent="deleteAppointment(appointment.id)">
                                                <i class="fa fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div></template>
