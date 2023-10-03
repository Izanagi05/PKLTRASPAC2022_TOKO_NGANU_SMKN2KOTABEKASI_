<template>
  <div>
    <div class="container ">
      <div class="mb-2">
        <NuxtLink to="/" class="my-2 text-decoration-none black--text">
          Home </NuxtLink
        ><span class="mdi mdi-chevron-right"><b>Profil Pengguna</b></span>
      </div>
      <div
        :class="[
          'font-weight-bold  mb-2',
          $vuetify.breakpoint.smAndDown ? 'text-subtitle-1' : 'text-h6',
        ]"
      >
        Profil Pengguna
      </div>
      <div>
        <div class="d-flex mt-4">
          <v-avatar class="foto-profilan" style="width: 14vw; height: 14vw">
            <v-img
              v-if="dataprofil.foto_profil"
              class="img-fluid"
              :src="'http://127.0.0.1:8000/storage/' + dataprofil.foto_profil"
            />
          </v-avatar>

          <div class="d-flex ml-8 align-center">
            <div class="">
              <div class="text-h4 font-weight-medium">
                {{ dataprofil.nama }}
              </div>
              <div class="grey--text text-subtitle-1">
                {{ dataprofil.email }}
              </div>
            </div>
          </div>
        </div>
        <v-row class=" mt-4">
          <v-col cols="12" class="">
            <div class="font-weight-bold text-h6">Info pengguna</div>
          </v-col>
          <v-col cols="12" lg="12" md="12">
            <v-row >
              <v-col cols="2">
                <div class="grey--text text-body-1 mb-4">Telepon:</div>
                <div class="grey--text text-body-1">Email:</div>
              </v-col>
              <v-col cols="4">
                <div class="black--text font-weight-medium mb-4">
                  {{ dataprofil.no_telepon }}
                </div>
                <div class="black--text font-weight-medium">
                  {{ dataprofil.email }}
                </div>
              </v-col>
              <v-col cols="2" class="d-flex justify-content-end">
                <div class="grey--text text-body-1">Nama:</div>
              </v-col>
              <v-col cols="4" class="d-flex justify-content-end">
                <span class="black--text font-weight-medium">{{
                  dataprofil.nama
                }}</span>
              </v-col>
            </v-row>
          </v-col>
          <v-col cols="12" class="mt-4 d-flex justify-center">
            <v-btn
              class=" font-weight-medium px-15"
              outlined

              rounded
              @click="pushprofil"
            >
              Edit Profil
            </v-btn>
          </v-col>
        </v-row>
      </div>

      <!-- <v-row dense justify="center">
              <v-col cols="6" lg="6" md="6" sm="4">
                <p>Nama</p>
              </v-col>
              <v-col cols="6" lg="6" md="6" sm="8">
                <p>{{ dataprofil.nama }}</p>
              </v-col>
            </v-row>
            <v-row dense justify="center">
              <v-col cols="12">
                <div
                  :class="[
                    'font-weight-bold',
                    $vuetify.breakpoint.smAndDown ? '' : 'text-h6',
                  ]"
                >
                  Info Kontak
                </div>
              </v-col>
            </v-row>
            <v-row dense justify="center">
              <v-col cols="6" lg="6" md="6" sm="4">
                <p>Telepon</p>
                <p>Email</p>
              </v-col>
              <v-col cols="6" lg="6" md="6" sm="8">
                <p>{{ dataprofil.no_telepon }}</p>
                <p>{{ dataprofil.email }}</p>
              </v-col>
            </v-row>
            <v-btn
                class="profil-btn font-weight-medium"
                style="font-size: 24px; font-family: Poppins, sans-serif"
                outlined
                block
                rounded
                height="40px"
                @click="pushprofil"
              >
                Edit Profil
              </v-btn>
           -->
    </div>
  </div>
</template>

<script>
import axios from "axios";

// import ProfileUser from "~/pages/profile-user";
// import TokoUser from "~/pages/toko-user";

export default {
  layout: "UserView",
  // components: {
  //   ProfileUser,
  //   TokoUser,
  // },
  middleware: "middlewareku",
  data() {
    return {
      routersdata: [],
      avatarResp: 250,
      dataprofil: {
        nama: null,
        no_telepon: null,
        email: null,
      },
      cekuserrole: null,
      userid: null,
      menus: [
        {
          title: "User Profile",
          link: "/user-view/profile-user",
          icon: "mdi-account",
        },
        { title: "Toko", link: "/user-view/toko-user", icon: "mdi-storefront" },
        {
          title: "Tambah Toko",
          link: "/user-view/tambah-toko",
          icon: "mdi-store-plus",
        },
        {
          title: "Tambah Barang",
          link: "/user-view/crud",
          icon: "mdi-package-variant-closed-plus",
        },
      ],
    };
  },

  methods: {
    responsAv() {
      if (this.$vuetify.breakpoint.mdAndUp) {
        this.avatarResp = 250;
      } else if (this.$vuetify.breakpoint.smAndUp) {
        this.avatarResp = 10;
      }
    },
    rutess() {
      var rutes = [
        {
          show: true,
          nama: "Info User",
          rt: "/user-view",
          icon: "mdi-account",
        },
        {
          show: this.cekuserrole === "Admin",
          nama: "Admin",
          rt: "/halaman-admin",
          icon: "mdi-account-tie",
        },
        {
          show: true,
          nama: "Toko",
          rt: "/user-view/toko-user",
          icon: "mdi-storefront",
        },
        {
          show: true,
          nama: "Buka Toko",
          rt: "/user-view/tambah-toko",
          icon: "mdi-store-plus",
        },
        {
          show: true,
          nama: "Tambah Barang",
          rt: "/user-view/tambah-barang",
          icon: "mdi-package-variant-closed-plus",
        },
      ];
      this.routersdata = rutes.filter(function (link) {
        return link.show;
      });
    },
    getuser() {
      axios
        .get("http://127.0.0.1:8000/api/getuserlogin/" + this.userid)
        .then((respon) => {
          this.dataprofil = respon.data?.data;
        });
    },
    logout() {
      this.$store.dispatch("users/logout");
    },
    pushprofil() {
      this.$router.push("/user-view/edit-profil");
    },
  },

  created() {
    this.responsAv();
    const usid = this.$cookies.get("cookieku");
    this.userid = usid.data.id;
    this.cekuserrole = usid.role;
    this.rutess();
    this.getuser();
  },
  mounted() {
    this.getuser();
  },
};
</script>
<style scoped>
.pembatas {
  border-left: 8px solid #d9d9d9;
  border-radius: 20px;
  height: 450px;
  margin-right: 10px;
}
</style>
