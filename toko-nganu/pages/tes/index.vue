<template>
  <div>
    <v-skeleton-loader v-if="isLoading" type="list-item"></v-skeleton-loader>
    <div v-else>
      <span>Hallo tot</span>
    </div>
  </div>
</template>
  
  <script>
export default {
  data() {
    return {
      isLoading: true,
    };
  },
  mounted() {
    // Simulate loading delay
    setTimeout(() => {
      this.isLoading = false;
    }, 2000);
  },
};
</script>
  