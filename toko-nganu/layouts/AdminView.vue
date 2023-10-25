<template>
  <div>
    <v-app>
      <v-row class="">
        <v-col cols="3" class="btn-warnaku pr-0">
          <div class="py-4 pl-4 pr-0">
            <div class="py-5 pl-5 pr-0 pt-8 rounded-lg" style="height: 100%">
              <v-img
                :src="require('~/assets/logonganu-putih.png')"
                class="mb-15"
                :max-width="$vuetify.breakpoint.smAndDown ? '20' : '30'"
              >
              </v-img>
              <div v-for="(rute, i) in routersku" :key="i">
                <v-btn
                  text
                  depressed
                  @click="$router.push(rute.rt)"
                  width="100%"
                  style="
                    border-top-left-radius: 30px !important;
                    border-bottom-left-radius: 30px !important;
                  "
                  :class="[
                    'font-weight-medium rounded-0 rounded-ts-xl rounded-bs-xl d-flex align-items my-4 justify-start py-6 text-capitalize',
                    'sidebtn-' + i,
                    isaktif(rute.rt)
                      ? 'font-weight-medium white  color '
                      : 'font-weight-regular white--text',
                  ]"
                >
                  <v-icon
                    large
                    :color="isaktif(rute.rt) ? '#2f432d' : '#ffffff'"
                    class="mr-2"
                    >{{ rute.icon }}</v-icon
                  >
                  <div>
                    {{ rute.nama }}
                  </div>
                </v-btn>
              </div>
            </div>
          </div>
        </v-col>
        <v-col cols="9">
          <div class="container">
            <div class="d-flex align-center justify-end">
              <v-menu
                v-model="menu"
                :close-on-content-click="false"
                :nudge-width="200"
                offset-x
              >
                <template v-slot:activator="{ on, attrs }">
                   <v-btn
                  elevation="2"
                  fab
                  v-bind="attrs" v-on="on"
                  color="#ffffff"
                  :small="$vuetify.breakpoint.smAndDown ? true : false"
                >
                  <v-avatar
                    class="foto-profilan bg-greyku"
                    :size="$vuetify.breakpoint.smAndDown ? '35' : '50'"
                  >
                    <v-img
                      :src="
                        'http://127.0.0.1:8000/storage/' +
                        datauserLoginKu?.foto_profil
                      "
                    />
                  </v-avatar>
                </v-btn>
                </template>
                <v-card tag="a" class="pa-4">
                  <div class="text-body-1 text-center mb-4  font-weight-medium">
                    Yakin ingin keluar?
                  </div>
                  <div class="d-flex justify-center">
                    <v-btn
                    class="text-capitalize px-8 text-body-1 font-weight-medium rounded-lg white--text"
                    color="#2f432d"
                    @click="logout"
                    >Logout</v-btn
                  >
                  </div>
                </v-card>
              </v-menu>
            </div>
          </div>
          <nuxt />
        </v-col>
      </v-row>
    </v-app>
  </div>
</template>

<script>
export default {
  data() {
    return {
      datauserLoginKu: [],
      showMenu: false,
      fav: true,
      menu: false,
      message: false,
      hints: true,
      user: {
        initials: "JD",
        fullName: "John Doe",
        email: "john.doe@doe.com",
      },
      routersku: [
        {
          nama: "Produk",
          rt: "/halaman-admin/management-produk",
          icon: "mdi-store-plus",
        },
        {
          nama: "User",
          rt: "/halaman-admin/management-user",
          icon: "mdi-package-variant-closed-plus",
        },
        {
          nama: "Log Aktivitas",
          rt: "/halaman-admin/management-logactivity",
          icon: "mdi-store-check-outline",
        },
      ],
    };
  },

  methods: {
    isaktif(pathh) {
      return this.$route.path === pathh;
    },
    logout() {
      this.$store.dispatch("users/logout");
    },
  },
  created() {
    this.datauserLoginKu = this.$cookies.get("cookieku")?.data;
  },
};
</script>
