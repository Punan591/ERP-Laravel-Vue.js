import Dashboard from './components/Dashboard.vue';
import ListAppointments from './pages/appointments/ListAppointments.vue';
import AppointmentForm from './pages/appointments/AppointmentForm.vue';
import UserList from './pages/users/UserList.vue';
import UpdateSetting from './pages/settings/UpdateSetting.vue';
import UpdateProfile from './pages/profile/UpdateProfile.vue';
import Login from './pages/auth/Login.vue';
import Message from './pages/message/Message.vue';
import ClientForm from './pages/clients/ClientForm.vue';
import ListClients from './pages/clients/ListClients.vue';

export default [
    {
        path: '/login',
        name: 'admin.login',
        component: Login,
    },

    {
        path: '/admin/dashboard',
        name: 'admin.dashboard',
        component: Dashboard,
    },

    {
        path: '/admin/appointments',
        name: 'admin.appointments',
        component: ListAppointments,
    },

    {
        path: '/admin/appointments/create',
        name: 'admin.appointments.create',
        component: AppointmentForm,
    },

    {
        path: '/admin/appointments/:id/edit',
        name: 'admin.appointments.edit',
        component: AppointmentForm,
    },

    {
        path: '/admin/users',
        name: 'admin.users',
        component: UserList,
    },

    {
        path: '/admin/settings',
        name: 'admin.settings',
        component: UpdateSetting,
    },

    {
        path: '/admin/profile',
        name: 'admin.profile',
        component: UpdateProfile,
    },
    {
        path: '/admin/messages',
        name: 'admin.messages',
        component: Message,
    },
    {
        path: '/admin/clients',
        name: 'admin.clients',
        component: ListClients,
    },
    {
        path: '/admin/clients/create',
        name: 'admin.clients.create',
        component: ClientForm,
    },
    {
        path: '/admin/clients/:id/edit',
        name: 'admin.clients.edit',
        component: ClientForm,
    }

]
