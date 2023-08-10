<script setup>
import axios from 'axios';
import { reactive, ref } from 'vue';

const form = reactive({
    email: '',
    password: '',
});

const loading = ref(false);

const errorMessage = ref('');
const handleSubmit = () => {
    loading.value = true;
    errorMessage.value = '';
    axios.post('/login', form)
        .then(() => {
            window.location.href = "/admin/dashboard";
        })
        .catch((error) => {
            errorMessage.value = error.response.data.message;
        })
        .finally(() => {
            loading.value = false;
        });
};
</script>

<template>
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Admin Panel</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Hi user sign in to see my cool work</p>
                <p style="text-align: center;">Username: admin@admin.com</p>
                <p style="text-align: center;">Password: 123456789</p>
                <div v-if="errorMessage" class="alert alert-danger" role="alert">
                    {{ errorMessage }}
                </div>
                <form @submit.prevent="handleSubmit">
                    <div class="input-group mb-3">
                        <input v-model="form.email" type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input v-model="form.password" type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    <span style="display: inline-block; padding-left: 5px;"></span>Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" :disabled="loading">
                                <div v-if="loading" class="spinner-border spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <span v-else>Sign In</span>
                            </button>
                        </div>

                    </div>
                </form>

                <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
            </div>

        </div>
    </div>
</template>

<style scoped>
/* Add custom styles below */
/* Custom styles for Remember Me checkbox */
.icheck-primary input[type="checkbox"] + label::before {
  content: '';
  position: absolute;
  top: 2px;
  left: 0;
  width: 20px;
  height: 20px;
  border: 2px solid #ffc107;
  border-radius: 5px;
  background-color: #fff;
}

.icheck-primary input[type="checkbox"]:checked + label::before {
  background-color: #ffc107;
  border-color: #ffc107;
}

.icheck-primary input[type="checkbox"]:focus + label::before {
  box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
}
.icheck-primary input[type="checkbox"] + label:hover::before {
  background-color: #ffeeba; /* Light yellow background on hover */
  border-color: #ffeeba;
}

/* Custom styles for Forgot Password link */
.mb-1 a {
  color: #ffc107;
  text-decoration: none;
}

.mb-1 a:hover {
  text-decoration: underline;
}
.login-box {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.card {
  width: 350px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border: none; /* Remove the border */
}

.card-header {
  background-color: #ffc107;
  color: #fff;
  border-radius: 10px 10px 0 0;
  padding: 15px;
}

.card-body {
  padding: 20px;
}

.login-box-msg {
  text-align: center;
  margin-bottom: 20px;
  font-size: 18px;
}

.alert {
  margin-bottom: 20px;
}

input[type="email"],
input[type="password"] {
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  width: 100%;
  margin-bottom: 10px;
}

.input-group-text {
  background-color: #ffc107;
  border: 1px solid #ffc107;
  color: #fff;
  border-radius: 5px;
}

.btn-primary {
  background-color: #ffc107;
  border: none;
  border-radius: 5px;
  padding: 10px;
  font-size: 16px;
  cursor: pointer;
  width: 100%;
}

.btn-primary:hover {
  background-color: #ffd600;
}

.spinner-border {
  display: inline-block;
  width: 1rem;
  height: 1rem;
  vertical-align: text-bottom;
  border: 0.2em solid currentColor;
  border-right-color: transparent;
  border-radius: 50%;
  animation: spinner-border 0.75s linear infinite;
}

@keyframes spinner-border {
  to {
    transform: rotate(360deg);
  }
}
</style>