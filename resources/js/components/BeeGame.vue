<template>
  <div class="bee-game">
    <h1>Bee Hitting Game</h1>
    <button @click="hitBee" :disabled="isButtonDisabled">Hit a Random Bee</button>
    <div v-if="message">{{ message }}</div>
    <h2>Bee Status:</h2>
    <ul>
      <li v-if="queenBee">Queen Bee: {{ queenBee.health }} HP</li>
      <li v-for="(bee, index) in workerBees" :key="'worker-' + index">
        Worker Bee {{ index + 1 }}: {{ bee.health }} HP
      </li>
      <li v-for="(bee, index) in droneBees" :key="'drone-' + index">
        Drone Bee {{ index + 1 }}: {{ bee.health }} HP
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

let isButtonDisabled = false;


// Initial bee states
const queenBee = ref(null);
const workerBees = ref([]);
const droneBees = ref([]);
const message = ref('');

// Fetch bee data from the backend API
async function fetchBees() {
  try {
    const response = await axios.get('/bees');
    const bees = response.data;
    queenBee.value = bees.find(bee => bee.type === 'Queen');
    workerBees.value = bees.filter(bee => bee.type === 'Worker');
    droneBees.value = bees.filter(bee => bee.type === 'Drone');
  } catch (error) {
    console.error('Error fetching bee data:', error);
  }
}

// Hit a random bee (dummy implementation)
async function hitBee() {
  isButtonDisabled = true; 
  const response = await axios.post('/hit-bee');
  fetchBees();
  message.value = response.data.message;
  if (response.data.status == "Game Over") {
    alert('Game Over!. You won the game');
  }
  isButtonDisabled = false; 
}

// Fetch bee data when the component is mounted
onMounted(() => {
  fetchBees();
});
</script>

<style scoped>
.bee-game {
  text-align: center;
  margin-top: 50px;
}
button {
  margin-top: 20px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  margin: 5px 0;
}
</style>
