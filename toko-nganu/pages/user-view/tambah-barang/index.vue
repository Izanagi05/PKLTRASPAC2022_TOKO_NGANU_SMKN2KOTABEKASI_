<template>
  <div>
    <div class="pb-5 font-weight-medium text-h6">Tambah barang</div>
    <div class="">
          <v-row>
            <v-col cols="12" lg="3" class="">
              <div class="">Nama Barang</div>
            </v-col>
            <v-col cols="12" lg="9">
              <v-text-field
                label=" Nama Barang"
                placeholder=" Nama Barang"
                solo
                class="rounded-lg"
                v-model="databarang.nama"
              ></v-text-field>
            </v-col>
            <v-col cols="12" lg="3" class="">
              <div class="">Kategori</div>
            </v-col>
            <v-col cols="12" lg="9">
              <v-expansion-panels class="panel">
                <v-expansion-panel solo class="panel-kategori">
                  <v-expansion-panel-header v-slot="{ open }">
                    <v-row no-gutters>
                      <v-col> Kategori </v-col>
                      <v-col cols="8" class="text--secondary">
                        <v-fade-transition leave-absolute>
                          <span v-if="open" key="0">Pilih Kategori </span>
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
                            class="grey kategori-select lighten-4"
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
              </v-expansion-panels>
            </v-col>
            <v-col cols="12" lg="3" class="">
              <div class="">Toko</div>
            </v-col>
            <v-col cols="12" lg="9">
              <v-expansion-panels solo class="">
                <v-expansion-panel solo class="">
                  <v-expansion-panel-header v-slot="{ open }">
                    <v-row no-gutters>
                      <v-col> Toko </v-col>
                      <v-col cols="8" class="text--secondary">
                        <v-fade-transition leave-absolute>
                          <span v-if="open" key="0">Pilih Toko</span>
                          <span v-else>
                            <div>
                              {{ getTokoText(databarang.toko_id) }}
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
                            class="toko-select"
                            v-model="databarang.toko_id"
                            :items="usertoko"
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
                      <v-btn text color="secondary" class="text-capitalize">
                        Cancel
                      </v-btn>
                      <v-btn text color="primary"> Save </v-btn>
                    </v-card-actions>
                  </v-expansion-panel-content>
                </v-expansion-panel>
              </v-expansion-panels>
            </v-col>
            <v-col cols="12" lg="3" class="">
              <div class="">Deskripsi</div>
            </v-col>
            <v-col cols="12" lg="9">
              <v-textarea
                solo
                class="rounded-lg"
                name="input-7-4"
                label="Deskripsi Barang"
                v-model="databarang.deskripsi"
              ></v-textarea>
            </v-col>
          </v-row>
      <v-row class="" justify="end">
        <v-col class="order-2 order-lg-1" cols="12"  lg="2"  md="12" sm="12" xs="12">
          <nuxt-link to="/user-view" class="text-decoration-none">
            <v-btn
              rounded-lg
              block
              outlined
              class=" text-capitalize"
            >
              Batal
            </v-btn>
          </nuxt-link>
        </v-col>
        <v-col class="order-1 order-lg-2" cols="12"  lg="2"  md="12" sm="12" xs="12">
          <v-btn
            rounded-lg
            block
            color="#2f432d"
            class="text-capitalize white--text"
            @click="tbhbarang()"
            >Buat</v-btn
          ></v-col
        >
      </v-row>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  layout: "UserView",
  middleware: "middlewareku",
  data() {
    return {
      // usertoko: [],
      userid: null,
      // kategori: [],
      databarang: {
        toko_id: null,
        nama: null,
        deskripsi: null,
        kategori_id: null,
      },
    };
  },
  computed: {
    usertoko() {
      return this.$store.state.toko.alldatatoko;
    },
    kategori() {
      return this.$store.state.kategori.alldatakategori;
    },
  },
  methods: {
    gettokouser() {
      // axios.get("http://127.0.0.1:8000/api/gettoko/" + this.userid).then((respon) => {
      //   this.usertoko = respon.data?.data;
      //   //  this.items = respon.data?.data
      // });
      this.$store.dispatch("toko/getdatatoko", this.userid);
    },
    getkategori() {
      // axios.get("http://127.0.0.1:8000/api/getallkategori").then((respon) => {
      //   this.kategori = respon.data?.data;
      // });
      this.$store.dispatch("kategori/getdatakategori");
    },
    tbhbarang() {
      // axios
      //   .post(
      //     "http://127.0.0.1:8000/api/createbarang/" + this.databarang.toko_id,
      //     this.databarang
      //   )
      //   .then((respon) => {
      //     this.$router.push("/");
      //     console.log(respon);
      //   });
      this.$store.dispatch("barang/tambahdata", this.databarang);
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
</script>

<style  scoped>
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



.button-aksi-jual {
  color: rgb(255, 255, 255) !important;
  background-color: #2f432d;
}

.button-aksi-jual:hover {
  background-color: #273826;
  /* background-color: #ffffff; */
  color: rgb(255, 255, 255) !important;
}

/* .gambar-produk {
  width: 200px;
  height: 200px;
  margin-left: 20px;
} */

.button-aksi {
  background: white;
}

/* .button-aksi:hover {
  background: white;
  color: white;
} */
.panel {
  margin-bottom: 30px;
}

.panel-kategori {
  margin-bottom: 30px;
}
</style>
