<template>
  <div class="messaging-container">
    <div class="sidebars">
      <div v-for="user in users" :key="user.id" @click="selectUser(user)" class="user-item">
        {{ user.name }}
      </div>
    </div>
    <div class="messages">
      <div v-for="message in messages" :key="message.id" class="message">
        <div :class="['message-bubble', message.fromMe ? 'from-me' : '']">
          {{ message.text }}
        </div>
      </div>
    </div>
    <div class="new-message">
      <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="Type a message..." />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import Pusher from 'pusher-js';

const users = ref([]);
const messages = ref([]);
const newMessage = ref('');
const selectedUser = ref(null);

onMounted(async () => {
  try {
    
    //const userId = await axios.get('/api/users');
    //myUserId.value = userId.data.id;

    const response = await axios.get('/api/users');
    users.value = response.data.data;  // Note the change here
    console.log(users.value);
    selectedUser.value = users.value[0];
  } catch (error) {
    console.error(error);
  }
  const pusher = new Pusher('d33f90981e088c5850d3', {
    cluster: 'ap2',
  });

  const channel = pusher.subscribe('private-user.' + users.value.id);

  channel.bind('new-message', (data) => {
    if (data.message.recipient_id === selectedUser.value.id) {
      messages.value.push(data.message);
    }
  });
});

const selectUser = (user) => {
  selectedUser.value = user;
  axios.get(`/messages?userId=${user.id}`).then((response) => {
    messages.value = response.data.messages;
  });
};

const sendMessage = () => {
  if (!selectedUser.value) {
    alert('Please select a user before sending a message.');
    return;
  }

  axios
    .post('/messages', {
      text: newMessage.value,
      recipientId: selectedUser.value.id,
    })
    .then((response) => {
      messages.value.push(response.data.message);
      newMessage.value = '';
    });
};
</script>

<style>
.messaging-container {
  display: flex;
  height: 100%;
}

.sidebars {
  width: 20%;
  border-right: 1px solid #ccc;
  padding: 10px;
  overflow-y: auto;
  background-color: white!important;
}

.user-item {
  padding: 10px;
  cursor: pointer;
  color: green;
}

.user-item:hover {
  background-color: #f1f0f0;
}

.messages {
  flex: 1;
  overflow-y: auto;
  padding: 10px;
}

.message {
  display: flex;
  justify-content: flex-start;
  margin-bottom: 10px;
}

.message-bubble {
  background-color: #f1f0f0;
  padding: 8px 12px;
  border-radius: 16px;
  max-width: 70%;
  word-break: break-word;
}

.from-me {
  align-self: flex-end;
  background-color: #007bff;
  color: white;
}

.new-message {
  display: flex;
  align-items: center;
  padding: 10px;
  border-top: 1px solid #ccc;
}

.new-message input {
  flex: 1;
  padding: 8px 12px;
  border: none;
  border-radius: 20px;
  outline: none;
}
</style>
