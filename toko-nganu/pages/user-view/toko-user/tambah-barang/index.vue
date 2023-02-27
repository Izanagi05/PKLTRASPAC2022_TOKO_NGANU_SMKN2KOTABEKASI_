<template>
  <div>
    <NavbarPolos />
    <div class="toko-container">
      <center>
        <v-card
          flat
          max-width="500"
          max-height="950"
          variant="outlined"
          style="margin-top: 100px"
        >
          <v-card flat>
            <div>
              <div
                class="judul text-h3 font-weight-bold pb-4"
                style="font-family: 'Poppins', sans-serif"
              >
                Tambah barang toko
              </div>
            </div>
            <v-sheet width="400">
              <v-form>
                <v-text-field
                  v-model="databarang.nama"
                  placeholder="Nama"
                ></v-text-field>
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
                <div class="button pb-6 pt-5">
                  <v-row>
                    <v-col cols="4">
                      <div class="batal">
                        <v-btn
                          class="rounded-pill"
                          x-large
                          outlined
                          @click="backprofil"
                          >Batal</v-btn
                        >
                      </div>
                    </v-col>
                    <v-col cols="6">
                      <div class="bayar">
                        <v-btn
                          class="rounded-pill"
                          width="207px"
                          x-large
                          outlined
                          style="background: #2f432d; color: white; size: 105px"
                          @click="tbhbarang()"
                          >Tambah</v-btn
                        >
                      </div>
                    </v-col>
                  </v-row>
                </div>
              </v-form>
            </v-sheet>
          </v-card>
        </v-card>
      </center>
    </div>
  </div>
</template>

<style>
.toko-container {
  padding: 0px 123px;
}
</style>

<script>
import axios from "axios";
export default {
  middleware: "middlewareku",
  data() {
    return {
      // items:null,
      usertoko: null,
      userid: null,
      kategori: null,
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
          this.$router.push("/toko-user");
          console.log(respon);
        });
    },
    tbhbarang() {
      axios
        .post(
          "http://127.0.0.1:8000/api/createbarang/" + this.databarang.toko_id,
          this.databarang
        )
        .then((respon) => {
          this.$router.push("/user-view/toko-user");
          console.log(respon);
        });
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
</script>
