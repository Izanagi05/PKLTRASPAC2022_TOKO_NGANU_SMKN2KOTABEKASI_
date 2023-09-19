<template>
  <div>
    <v-app>

      <Navbar />
      <div class="container">

        <v-row>
          <v-col
          cols="12 "
          lg="3"
          md="3"
          sm="12"
          xs="12"
          order="2"
          class="kiri justify-space-between order-lg-1 order-md-1 order-sm-2 order-xs-2"
        >
          <div>
            <div v-for="(rute, i) in routersdata" :key="i">
              <v-btn
                text
                depressed
                @click="$router.push(rute.rt)"
                width="100%"
                class="font-weight-medium d-flex align-items justify-start py-8 text-capitalize"
              >
                <v-icon large color="#616161" class="mr-2">{{
                  rute.icon
                }}</v-icon>
                {{ rute.nama }}
              </v-btn>
            </div>
            <div>
              <v-btn
                text
                depressed
                @click="logout()"
                width="100%"
                class="font-weight-medium d-flex align-items justify-start py-8 text-capitalize"
                ><v-icon large color="#616161" class="mr-2">mdi-logout</v-icon
                >Logout</v-btn
              >
            </div>
          </div>
        </v-col>
      <v-col  cols="12"
          lg="9"
          md="9"
          sm="12"
          xs="12"
          order="1"
          class="d-flex my-0 order-lg-2 order-md-2 order-sm-1 order-xs-1">
          <nuxt />
      </v-col>
    </v-row>
  </div>
  </v-app>
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
      // menus: [
      //   {
      //     title: "User Profile",
      //     link: "/user-view/profile-user",
      //     icon: "mdi-account",
      //   },
      //   { title: "Toko", link: "/user-view/toko-user", icon: "mdi-storefront" },
      //   {
      //     title: "Tambah Toko",
      //     link: "/user-view/tambah-toko",
      //     icon: "mdi-store-plus",
      //   },
      //   {
      //     title: "Tambah Barang",
      //     link: "/user-view/crud",
      //     icon: "mdi-package-variant-closed-plus",
      //   },
      // ],
    };
  },

  methods: {
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
    this.cekuserrole = usid.role;
    this.getuser();
    this.rutess();
  },
  mounted() {
    this.getuser();
  },
};
</script>

<style>
.contact {
  background-color: #2f432d;
  padding: 5px 0px 7px 154px;
}
.home-container {
  padding: 0px 123px;
}
.content {
  display: flex;
  gap: 38px;
}
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
  margin-top: 120px;
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
.profil-btn {
  height: 30px;
  width: 114px;
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

