<template>
  <div>
    <Navbar />
    <div class="crud-container">
      <v-row class="judul">
        <v-col cols="12" md="6"> Tambah Produk</v-col>
      </v-row>

      <v-row dense justify="center">
        <v-col cols="12" sm="3"
          ><div class="list">Nama Barang</div>
          <div class="list">Kategori</div>
          <div class="list">Toko</div>
          <div class="list">Deskripsi</div></v-col
        >
        <v-col cols="12" sm="6">
          <v-text-field
            label="Nama Barang"
            placeholder="Masukan Nama Barang"
            solo
            v-model="databarang.nama"
          ></v-text-field>
          <v-expansion-panels class="panel">
            <v-expansion-panel class="panel-kategori">
              <v-expansion-panel-header v-slot="{ open }">
                <v-row no-gutters>
                  <v-col> Kategori </v-col>
                  <v-col cols="8" class="text--secondary">
                    <v-fade-transition leave-absolute>
                      <span v-if="open" key="0"> Pilih Kategori </span>
                      <span v-else>
                        <div>
                          {{ getKategoriText(databarang.kategori_id) }}
                        </div>
                      </span>
                    </v-fade-transition>
                  </v-col>
                </v-row>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <v-row no-gutters>
                  <v-spacer></v-spacer>
                  <v-col cols="5">
                    <div>
                      <v-select
                        v-model="databarang.kategori_id"
                        :items="kategori"
                        item-text="nama"
                        item-value="kategori_id"
                        chips
                        flat
                        solo
                      ></v-select>
                    </div>
                  </v-col>
                </v-row>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn text color="secondary"> Cancel </v-btn>
                  <v-btn text color="primary"> Save </v-btn>
                </v-card-actions>
              </v-expansion-panel-content>
            </v-expansion-panel>

            <v-expansion-panel>
              <v-expansion-panel-header v-slot="{ open }">
                <v-row no-gutters>
                  <v-col> Toko </v-col>
                  <v-col cols="8" class="text--secondary">
                    <v-fade-transition leave-absolute>
                      <span v-if="open" key="0"> Pilih Toko </span>
                      <span v-else key="1">
                        <div v-for="(toko, index) in usertoko" :key="index">
                          {{ toko.nama }}
                        </div>
                      </span>
                    </v-fade-transition>
                  </v-col>
                </v-row>
              </v-expansion-panel-header>
              <v-expansion-panel-content>
                <v-row no-gutters>
                  <v-spacer></v-spacer>
                  <v-col cols="5">
                    <div>
                      <v-select
                        v-model="databarang.toko_id"
                        :items="toko"
                        item-text="nama"
                        item-value="toko_id"
                        chips
                        flat
                        solo
                      ></v-select>
                    </div>
                  </v-col>
                </v-row>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn text color="secondary"> Cancel </v-btn>
                  <v-btn text color="primary"> Save </v-btn>
                </v-card-actions>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>

          <v-textarea
            solo
            name="input-7-4"
            label="Deskripsi Barang"
            v-model="databarang.deskripsi"
          ></v-textarea
        ></v-col>
        <v-col cols="12" sm="3"
          ><div class="gambar-produk">
            <v-img
              dense
              justify="center"
              contain
              max-height="200"
              max-width="200"
              :src="require('~/assets/barang.png')"
            ></v-img>
          </div>
          <v-btn
            rounded
            outlined
            class="edit-image"
            width="200px"
            height="40px"
          >
            Tambah Foto
          </v-btn></v-col
        >
      </v-row>
      <v-row class="judul" justify="end">
        <v-col cols="12" md="2"
          ><nuxt-link to="/user-view"
            ><v-btn rounded outlined width="150px" class="button-aksi"
              >Batal</v-btn
            ></nuxt-link
          ></v-col
        ><v-col cols="12" md="2"
          ><v-btn
            outlined
            rounded
            width="150px"
            class="button-aksi-jual"
            @click="tbhbarang()"
            >Jual</v-btn
          ></v-col
        >
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