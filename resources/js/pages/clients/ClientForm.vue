<script setup>
import axios from 'axios';
import { reactive, onMounted, ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { useToastr } from '@/toastr';
import { Form } from 'vee-validate';
import flatpickr from "flatpickr";
import 'flatpickr/dist/themes/light.css';

const router = useRouter();
const route = useRoute();
const toastr = useToastr();
const form = reactive({
    first_name: '',
    last_name: '',
    email: '',
});

const handleSubmit = (values, actions) => {
    if (editMode.value) {
        editClient(values, actions);
    } else {
        createClient(values, actions);
    }
};

const createClient = (values, actions) => {
    axios.post('/api/clients/create', form)
    .then((response) => {
        router.push('/admin/clients');
        toastr.success('Client created successfully!');
    })
    .catch((error) => {
        actions.setErrors(error.response.data.errors);
    })
};

const editAppointment = (values, actions) => {
    axios.put(`/api/clients/${route.params.id}/edit`, form)
    .then((response) => {
        router.push('/client/appointments');
        toastr.success('Client updated successfully!');
    })
    .catch((error) => {
        actions.setErrors(error.response.data.errors);
    })
};

//const clients = ref();
//nst getClients = () => {
//  axios.get('/api/clients')
//  .then((response) => {
//      clients.value = response.data;
//  })
//

const getClient = () => {
    axios.get(`/api/clients/${route.params.id}/edit`)
    .then(({data}) => {
        form.first_name = data.first_name;
        form.last_name = data.last_name;
        form.email = data.email;
        //form.end_time = data.formatted_end_time;
        //form.description = data.description;
    })
};

const editMode = ref(false);

onMounted(() => {
    if (route.name === 'admin.clients.edit') {
        editMode.value = true;
        getClient();
    }

//  flatpickr(".flatpickr", {
//      enableTime: true,
//      dateFormat: "Y-m-d h:i K",
//      defaultHour: 10,
//  });
//  getClients();
});
</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <span v-if="editMode">Edit</span>
                        <span v-else>Create</span>
                        Client</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link to="/admin/dashboard">Home</router-link>
                        </li>
                        <li class="breadcrumb-item">
                            <router-link to="/admin/clients">Clients</router-link>
                        </li>
                        <li class="breadcrumb-item active">
                            <span v-if="editMode">Edit</span>
                            <span v-else>Create</span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <Form @submit="handleSubmit" v-slot:default="{ errors }">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input v-model="form.first_name" type="text" class="form-control" :class="{ 'is-invalid': errors.first_name }" id="title" placeholder="Enter First Name">
                                            <span class="invalid-feedback">{{ errors.first_name }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input v-model="form.last_name" type="text" class="form-control" :class="{ 'is-invalid': errors.last_name }" id="title" placeholder="Enter Last Name">
                                            <span class="invalid-feedback">{{ errors.last_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input v-model="form.email" type="text" class="form-control" :class="{ 'is-invalid': errors.email }" id="title" placeholder="Enter Email">
                                            <span class="invalid-feedback">{{ errors.email }}</span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" style="background-color: #ffc107;border: none;">Submit</button>
                            </Form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
