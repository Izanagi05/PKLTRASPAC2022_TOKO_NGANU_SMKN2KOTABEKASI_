<template>
  <v-app-bar class="non-fixed-app-bar" color="transparent" elevation="0">
    <v-btn icon @click="goBack">
      <v-icon color="white">mdi-arrow-left</v-icon>
    </v-btn>

    <v-spacer></v-spacer>
    <v-dialog v-model="dialogsearch" max-width="600px">
      <v-card class="pa-6 rounded-xl">
        <v-text-field
          class="nyari rounded-lg"
          v-model="cari"
          label="Cari Nganu"
          single-line
          hide-details
          outlined
          @keyup.enter="
            cari === '' || cari === null ? getkategori(-1) : getkategori(-2)
          "
          append-icon="mdi-magnify"
          placehoder="cari"
        ></v-text-field>
      </v-card>
    </v-dialog>
    <v-btn icon @click="dialogsearch = true">
      <v-icon color="white">mdi-magnify</v-icon>
    </v-btn>
    <nuxt-link to="/keranjang" class="text-decoration-none"
      ><v-btn icon>
        <v-icon color="white">mdi-cart</v-icon>
      </v-btn></nuxt-link
    >
    <nuxt-link to="/user-view" class="text-decoration-none"
      ><v-avatar size="36">
        <v-img
                      :src="
                        'http://127.0.0.1:8000/storage/' +
                        datauserLoginKu?.foto_profil
                      "/>
      </v-avatar
    ></nuxt-link>
  </v-app-bar>
</template>

  <script>
export default {
  data() {
    return {
      dialogsearch: false,
    };
  },
  methods: {
    goBack() {
      this.$router.go(-1);
    },
  },
};
</script>

  <style scoped>
.non-fixed-app-bar {
  position: absolute;
  padding-top: 20px;
  z-index: 1000;
}
</style>
