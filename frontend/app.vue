<template>
  <div class="container">
    <Header />
    <Panel class="mt-2">
      <NuxtPage />
    </Panel>
  </div>
</template>

<script setup lang="ts">
import Header from './components/Base/Header.vue'
</script>

<style>
.container {
  max-width: 1320px;
  margin: 0 auto;
  padding: 0.75rem;
}
</style>