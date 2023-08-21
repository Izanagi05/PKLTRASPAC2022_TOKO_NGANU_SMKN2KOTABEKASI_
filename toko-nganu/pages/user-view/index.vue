<template>
  <div>
    <Navbar />
    <div class="container">
      <v-row class="">
        <v-col cols="12 " lg="4" md="4" sm="12" xs="12" order="2"
          class="kiri d-flex justify-space-between py-0 order-lg-1 order-md-1 order-sm-2  order-xs-2">
          <div>
            <div class="sub-title" style="margin-left: 27px, margin-right=36px">
              Profil Pengguna
            </div>
            <div class="menu mt-2">
              <v-row justify="center">
                <v-col cols="4" lg="12" sm="4" class="pa-0 my-4" md="12">
                  <NuxtLink to="/user-view" class=" black--text d-flex text-decoration-none">
                    <v-icon large>mdi-account</v-icon> Info User
                  </NuxtLink>
                </v-col>
                <v-col cols="4" lg="12" sm="4" class="pa-0 my-4" md="12" v-if="cekuserrole == 'Admin'">
                  <NuxtLink to="/halaman-admin" class=" black--text d-flex text-decoration-none">
                    <v-icon large>mdi-account-tie</v-icon> Admin
                  </NuxtLink>
                </v-col>
                <v-col cols="4" lg="12" sm="4" class="pa-0 my-4" md="12" v-else>
                </v-col>

                <v-col cols="4" lg="12" sm="4" class="pa-0 my-4" md="12">
                  <NuxtLink to="/user-view/toko-user" class=" black--text d-flex text-decoration-none">
                    <v-icon large>mdi-storefront</v-icon> Toko
                  </NuxtLink>
                </v-col>
                <v-col cols="4" lg="12" sm="4" class="pa-0 my-4" md="12">
                  <NuxtLink to="/user-view/tambah-toko" class=" black--text d-flex text-decoration-none">
                  <v-icon large>mdi-store-plus</v-icon> Buka Toko
                </NuxtLink>
              </v-col>
                <v-col cols="3" lg="12" sm="4" class="pa-0 my-4" md="12">
                  <NuxtLink to="/user-view/crud" class=" black--text d-flex text-decoration-none">
                    <v-icon large>mdi-package-variant-closed-plus</v-icon> tambah barang
                  </NuxtLink>
                </v-col>
              </v-row>
            </div>
            <div class="logout" >
              <v-btn text @click="logout()" class=""><v-icon>mdi-logout</v-icon>Logout</v-btn>
            </div>
          </div>
        </v-col>

        <v-col cols="12" lg="8" md="8" sm="12" xs="12" order="1"
          class="profil d-flex my-0 order-lg-2 order-md-2 order-sm-1 order-xs-1">
          <div class="pembatas mr-8"></div>
          <div class="">

            <div class="navigasi">
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
                    <!-- <p>Alamat</p> -->
                  </v-col>
                  <v-col cols="6" lg="6" md="6" sm="8">
                    <p>{{ dataprofil.nama }}</p>
                  </v-col>
                </v-row>
                <v-row dense justify="center">
                  <v-col cols="12">
                    <div class="informasi-judul">Info Kontak</div>
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

export default {
  middleware: "middlewareku",
  data() {
    return {
      dataprofil: {
        nama: null,
        no_telepon: null,
        email: null,
      },
      cekuserrole: null,
      userid: null,
    };
  },

  methods: {
    getuser() {
      axios
        .get("http://127.0.0.1:8000/api/getuserlogin/" + this.userid)
        .then((respon) => {
          this.dataprofil = respon.data;
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
    const usid = this.$cookies.get("cookieku");
    this.userid = usid.data.id;
    this.getuser();
    this.cekuserrole = usid.role;
  },
  mounted() {
    this.getuser();
  },
};
</script>
<style scoped>
.contact {
  background-color: #2f432d;
  padding: 5px 0px 7px 154px;
}

.home-container {
  padding: 0px 123px;
}

/* .content {
  display: flex;
  gap: 38px;
} */
.sub-title {
  font-family: "Poppins", sans-serif;
  font-weight: 700;
  font-size: 24px;
}

.menu {
  display: grid;
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-size: 20px;
  /* margin-top: 69px; */
}

.logout {
  /* margin-top: 120px; */
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-size: 20px;
}

.pembatas {
  border-left: 8px solid #d9d9d9;
  border-radius: 20px;
  height: 450px;
  margin-right: 10px;
}

.profil-btn:hover {
  background: #2f432d;
  color: rgb(255, 255, 255);
}

.kiri {
  margin-top: 19px;
}

.my-link {
  text-decoration: none;
  color: #000000;
  margin-bottom: 43px;
}

.isi {
  margin-top: 26px;
}

.btn-card {
  margin-top: 30px;
}

.informasi-judul {
  font-family: Poppins;
  font-weight: 700;
  font-size: 20px;
}

.foto-profilan {
  background: #d9d9d9;
}
</style>
