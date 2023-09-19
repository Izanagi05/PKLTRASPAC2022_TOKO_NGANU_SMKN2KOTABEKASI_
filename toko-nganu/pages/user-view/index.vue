<template>
  <div>
    <Navbar />
    <div class="container">
      <div
                  :class="['font-weight-bold  mb-2', $vuetify.breakpoint.smAndDown?'text-h6':'text-h5']"
                >
                  Profil Pengguna
                </div>
      <v-row class="">
        <v-col cols="12 " lg="4" md="4" sm="12" xs="12" order="1" class="kiri d-flex justify-space-between py-0 order-lg-1 order-md-1 order-sm-2 order-xs-2">
        <v-col
          cols="12 "
          lg="3"
          md="3"
          sm="12"
          xs="12"
          order="2"
          class="kiri  justify-space-between  order-lg-1 order-md-1 order-sm-2 order-xs-2"
        >
          <div>
            <div class=" align-center align-space-between">
              <div>

                <v-row  class="ma-0 ">
                  <v-col
                    cols="12"
                    lg="12"
                    sm="6"
                    class="pa-0 "
                    md="12"
                    v-for="(rute, i) in routersdata"
                    :key="i"
                  >
                  <v-btn text depressed @click="$router.push(rute.rt)" width="100%"  class="font-weight-medium d-flex align-items justify-start py-8 text-capitalize"
                >
                      <v-icon large color="#616161" class="mr-2">{{ rute.icon }}</v-icon> {{ rute.nama }}
                  </v-btn>
                  </v-col>
                </v-row>
              </div>
            </div>
            <v-col cols="4" lg="12" sm="4" class="pa-0 my-4" md="12">
              <v-btn text depressed @click="logout()"  width="100%"  class="font-weight-medium d-flex align-items justify-start py-8 text-capitalize"
                ><v-icon large color="#616161" class="mr-2">mdi-logout</v-icon>Logout</v-btn
              >
            </v-col>
          </div>
        </v-col>
        <v-col
          cols="12"
          lg="9"
          md="9"
          sm="12"
          xs="12"
          order="1"
          class=" d-flex my-0 order-lg-2 order-md-2 order-sm-1 order-xs-1"
        >
          <div v-if="$vuetify.breakpoint.mdAndUp" class="pembatas mr-8"></div>
          <div >
            <div  class="mb-2">
              <NuxtLink to="/" class="my-2 text-decoration-none black--text">
                Home </NuxtLink><span class="mdi mdi-chevron-right"><b>Profil Pengguna</b></span>
            </div>
            <v-row class="isi">
              <v-col>
                <div class="foto-profil d-flex justify-center">
                  <v-avatar class="foto-profilan" style="width:20vw;height: 20vw;">
                    <img v-if="dataprofil.foto_profil" class="img-fluid" :src="'http://127.0.0.1:8000/storage/' + dataprofil.foto_profil
                      " />
                  </v-avatar>
                </div>
                <div class="btn-card pl-1 pb-1">
                  <v-btn class="profil-btn  font-weight-medium" style="font-size: 24px; font-family: Poppins, sans-serif"
                    outlined block rounded height="40px" @click="pushprofil">
                    Edit Profil
                  </v-btn>
                </div>
              </v-col>
              <v-col>
                <v-row dense justify="center">
                  <v-col cols="12">
                    <div class="informasi-judul">Info Pengguna</div>
                  </v-col>
                </v-row>

                <v-row dense justify="center">
                  <v-col cols="6" lg="6" md="6" sm="4">
                    <p>Nama</p>
                  </v-col>
                  <v-col cols="6" lg="6" md="6" sm="8">
                    <p>{{ dataprofil.nama }}</p>
                  </v-col>
                </v-row>
                <v-row dense justify="center">
                  <v-col cols="12">
                    <div :class="['font-weight-bold', $vuetify.breakpoint.smAndDown?'':'text-h6']">Info Kontak</div>
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
              </v-col>
            </v-row>
          </div>
        </v-col>
      </v-row>
    </div>
  </div>
</template>

<script>
import axios from "axios";

// import ProfileUser from "~/pages/profile-user";
// import TokoUser from "~/pages/toko-user";

export default {
  // components: {
  //   ProfileUser,
  //   TokoUser,
  // },
  middleware: "middlewareku",
  data() {
    return {
      routersdata: [],
      avatarResp:250,
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
    responsAv(){
      if(this.$vuetify.breakpoint.mdAndUp){
        this.avatarResp=250
      }else if(this.$vuetify.breakpoint.smAndUp){
        this.avatarResp=10
      }
    },
    rutess() {
      var rutes = [
        { show: true, nama: "Info User", rt: "/user-view", icon: "mdi-account" },
        { show: this.cekuserrole === 'Admin',nama: "Admin", rt: "/halaman-admin", icon: "mdi-account-tie" },
        { show: true, nama: "Toko", rt: "/user-view/toko-user", icon: "mdi-storefront" },
        { show: true, nama: "Buka Toko", rt: "/user-view/tambah-toko", icon: "mdi-store-plus" },
        {
          show: true, nama: "Tambah Barang",
          rt: "/user-view/tambah-barang",
          icon: "mdi-package-variant-closed-plus",
        },
      ];
      this.routersdata= rutes.filter(function (link) {
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
