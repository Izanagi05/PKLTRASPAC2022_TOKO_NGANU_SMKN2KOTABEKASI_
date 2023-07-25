<template>
  <div>
    <NavbarPolos />
    <div class="toko-container">
      <div>Tambah barang toko</div>
      <v-text-field v-model="databarang.nama" placeholder="Nama"></v-text-field>
      <v-text-field
        v-model="databarang.deskripsi"
        placeholder="Deskripsi"
      ></v-text-field>
      <!-- <v-text-field v-model="databarang.kategori_id" placeholder="Kategori"></v-text-field> -->
      <!-- {{ usertoko }} -->
      <select v-model="databarang.kategori_id" label="Pilih">
        <option disabled>Pilih Toko</option>
        <option
          v-for="(toko, index) in kategori"
          :value="toko.kategori_id"
          :key="index"
        >
          {{ toko.nama }}
        </option>
      </select>
      <select v-model="databarang.toko_id" label="Pilih">
        <option disabled>Pilih Toko</option>
        <option
          v-for="(toko, index) in usertoko"
          :value="toko.toko_id"
          :key="index"
        >
          {{ toko.nama }}
        </option>
      </select>
      <v-btn @click="tbhbarang()">buat</v-btn>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  middleware: "middlewareku",
  data() {
    return {
      // items:null,
      usertoko: null,
      userid: null,
      kategori: [],
      databarang: {
        toko_id: null,
        nama: null,
        deskripsi: null,
        kategori_id: null,
      },
    };
  },

  methods: {
    gettokouser() {
      axios
        .get("http://127.0.0.1:8000/api/gettoko/" + this.userid)
        .then((respon) => {
          this.usertoko = respon.data;
          //  this.items = respon.data
        });
    },
    getkategori() {
      axios.get("http://127.0.0.1:8000/api/getallkategori").then((respon) => {
        this.kategori = respon.data;
      });
    },
    tbhbarang() {
      axios
        .post(
          "http://127.0.0.1:8000/api/createbarang/" + this.databarang.toko_id,
          this.databarang
        )
        .then((respon) => {
          this.$router.push("/");
          console.log(respon);
        });


    },
    getKategoriText(val) {
      const data = this.kategori.find((element) => element.kategori_id === val);
      if (data) {
        return data.nama;
      } else {
        return "";
      }
    },
    getTokoText(val) {
      const data = this.usertoko.find((element) => element.toko_id === val);
      console.log(data.nama);
      if (data) {
        return data.nama;
      } else {
        return "";
      }
    },
    backprofil() {
      this.$router.push("/user-view/toko-user");
    },
  },
  created() {
    const idnya = this.$cookies.get("cookieku");
    this.userid = idnya.data.id;
    this.gettokouser();
    this.getkategori();
  },
};
// export default {
//   data: () => ({
//     date: null,
//     trip: {
//       name: "",
//       location: null,
//       start: null,
//       end: null,
//     },
//     locations: [
//       "Australia",
//       "Barbados",
//       "Chile",
//       "Denmark",
//       "Ecuador",
//       "France",
//     ],
//   }),
// };
</script>

<style>
.crud-container {
  padding: 0px 281px;
}
.judul {
  font-family: Poppins;
  font-weight: 600;
  font-size: 40px;
  gap: 20px;
  margin-right: 20px;
}
.list {
  margin-bottom: 50px;
  font-family: Poppins;
  font-weight: 400;
  font-size: 20px;
}
.edit-image {
  margin-top: 20px;
  margin-left: 20px;
  height: 30px;
  width: 114px;
}
.edit-image:hover {
  background: #2f432d;
  color: rgb(255, 255, 255);
}
.button-aksi-jual {
  color: rgb(255, 255, 255) !important;
  background-color: #2f432d;
}
.button-aksi-jual:hover {
  background-color: #ffffff;
  color: rgb(0, 0, 0) !important;
}
.gambar-produk {
  width: 200px;
  height: 200px;
  margin-left: 20px;
}
.button-aksi:hover {
  background: #2f432d;
  color: white;
}
.panel {
  margin-bottom: 30px;
}
.panel-kategori {
  margin-bottom: 30px;
}
</style>

