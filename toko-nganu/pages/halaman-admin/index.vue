<template>
  <div>
    <NavbarPolos />
    <v-dialog v-model="dialogDeleteuser" max-width="500px">
      <v-card>
        <v-card-title class="text-h5">Yakin ingin menghapus user?</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="closeDeleteuser"
            >Cancel</v-btn
          >
          <v-btn color="blue-darken-1" variant="text" @click="confirmhapususer"
            >OK</v-btn
          >
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialogDeletetoko" max-width="500px">
      <v-card>
        <v-card-title class="text-h5"
          >Yakin ingin menghapus Toko ini?</v-card-title
        >
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="closeDeletetoko"
            >Cancel</v-btn
          >
          <v-btn color="blue-darken-1" variant="text" @click="confirmhapustoko"
            >OK</v-btn
          >
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog v-model="dialogDeletebarang" max-width="500px">
      <v-card>
        <v-card-title class="text-h5"
          >Yakin ingin menghapus Barang ini?</v-card-title
        >
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="closeDeletebarang"
            >Cancel</v-btn
          >
          <v-btn
            color="blue-darken-1"
            variant="text"
            @click="confirmhapusbarang"
            >OK</v-btn
          >
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <div class="home-container">
      <div class="kiri">
        <div class="sub-title ml-5" width="170px" height="30px">
          Halaman Admin
        </div>
        <v-card>
          <v-tabs vertical>
            <v-tab>
              <v-card class="produk ml-6" style="font-size: 16px">
                <span class="mdi mdi-package-variant-closed">User</span>
              </v-card>
            </v-tab>
            <v-tab>
              <v-card class="tambah-produk ml-6" style="font-size: 16px">
                <span class="mdi mdi-package-variant-closed-plus">Toko</span>
              </v-card>
            </v-tab>
            <v-tab>
              <v-card class="tambah-produk ml-6" style="font-size: 16px">
                <span class="mdi mdi-package-variant-closed-plus">Barang</span>
              </v-card>
            </v-tab>
            <v-tab-item>
              <v-card flat class="items">
                <v-card
                  d-flex
                  max-width="344"
                  outlined
                  class="text-h5 mb-1 mx-auto"
                  v-for="(asr, index) in alluser"
                  :key="index"
                >
                  <v-list-item three-line>
                    <v-list-item-content>
                      <div class="text-overline mb-4">User</div>
                      <v-list-item-title>{{ asr.nama }} </v-list-item-title>
                      <v-list-item-subtitle>{{
                        asr.email
                      }}</v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-avatar
                      tile
                      size="80"
                      color="grey"
                    ></v-list-item-avatar>
                  </v-list-item>

                  <v-card-actions>
                    <v-btn outlined rounded text @click="hapususer(asr)">
                      Hapus
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-card>
            </v-tab-item>
            <v-tab-item>
              <v-card flat class="items">
                <v-card
                  d-flex
                  max-width="344"
                  outlined
                  class="text-h5 mb-1 mx-auto"
                  v-for="(atr, index) in alltoko"
                  :key="index"
                >
                  <v-list-item three-line>
                    <v-list-item-content>
                      <div class="text-overline mb-4">Toko</div>
                      <v-list-item-title>{{ atr.nama }} </v-list-item-title>
                      <v-list-item-subtitle>{{
                        atr.deskripsi
                      }}</v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-avatar
                      tile
                      size="80"
                      color="grey"
                    ></v-list-item-avatar>
                  </v-list-item>

                  <v-card-actions>
                    <v-btn outlined rounded text @click="hapustoko(atr)">
                      Hapus
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-card>
            </v-tab-item>
            <v-tab-item>
              <v-card flat class="items">
                <v-card
                  class="text-h5 mb-1 mx-auto"
                  max-width="344"
                  outlined
                  v-for="(brg, index) in allbarang"
                  :key="index"
                >
                  <v-list-item three-line>
                    <v-list-item-content>
                      <div
                        v-for="(grb, index) in brg.toko"
                        :key="index"
                        class="text-overline mb-4"
                      >
                        {{ nama }}
                      </div>
                      <v-list-item-title class="text-h5 mb-1">
                        {{ brg.nama }}
                      </v-list-item-title>
                      <v-list-item-subtitle>{{
                        brg.deskripsi
                      }}</v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-avatar
                      tile
                      size="80"
                      color="grey"
                    ></v-list-item-avatar>
                  </v-list-item>

                  <v-card-actions>
                    <v-btn outlined rounded text @click="hapusbarang(brg)">
                      Hapus
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-card>
            </v-tab-item>
          </v-tabs>
        </v-card>

        <!-- <div class="logout ml-6 pb-4" style="font-size: 16px">
          <span class="mdi mdi-logout mdi-35px">Logout</span>
        </div> -->
      </div>
    </div>
    <div>
      <v-dialog v-model="dialogDeletekategori" max-width="500px">
        <v-card>
          <v-card-title class="text-h5">Yakin ingin menghapus?</v-card-title>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="blue-darken-1"
              variant="text"
              @click="closeDeletekategori"
              >Cancel</v-btn
            >
            <v-btn
              color="blue-darken-1"
              variant="text"
              @click="confirmhapuskategori"
              >OK</v-btn
            >
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <v-dialog
        v-model="dialogEditkategori"
        max-width="700"
        persistent
        transition="dialog-bottom-transition"
      >
        <v-card
          class="kartu"
          light
          style="padding: 0px; color: black; border: solid 3px #4caf50"
        >
          <div style="background: #4caf50; padding: 10px 30px; color: white">
            <h1>Ubah data</h1>
          </div>
          <v-container style="padding: 30px">
            <v-text-field
              type="text"
              v-model="detaildatadialogkategori.nama"
              label="Name"
              outline
            ></v-text-field>
            <v-card-actions>
              <v-btn
                @click="closeedit()"
                style="margin-right: 20px; background: white; color: black"
                >Close</v-btn
              >
              <v-btn
                @click="updatekategori()"
                style="background: #4caf50; color: white"
                >Ubah</v-btn
              >
            </v-card-actions>
          </v-container>
        </v-card>
      </v-dialog>

      <v-dialog
        v-model="dialogTambahkategori"
        max-width="700"
        persistent
        transition="dialog-bottom-transition"
      >
        <v-card
          class="kartu"
          light
          style="padding: 0px; color: black; border: solid 3px #4caf50"
        >
          <div style="background: #4caf50; padding: 10px 30px; color: white">
            <h1>Tambah data</h1>
          </div>
          <v-container style="padding: 30px">
            <v-text-field
              type="text"
              v-model="detaildatadialogkategoritbh.nama"
              label="Name"
              outline
            ></v-text-field>
            <v-card-actions>
              <v-btn
                @click="closetambahkategori()"
                style="margin-right: 20px; background: white; color: black"
                >Close</v-btn
              >
              <v-btn
                @click="confirimtambahkategori()"
                style="background: #4caf50; color: white"
                >Simpan</v-btn
              >
            </v-card-actions>
          </v-container>
        </v-card>
      </v-dialog>

      <div style="padding: 0px 123px" class="py-8">
        <v-btn @click="tambahkategori">Tambah Kategori</v-btn>
      </div>
      <v-data-table
        style="padding: 30px 123px"
        :headers="headers"
        :items="allkategori"
      >
        <template v-slot:[`item.aksi`]="{ item }">
          <v-btn
            class="mx-2"
            fab
            small
            @click="ubahkategori(item)"
            style="margin: 15px 15px 15px 0px"
          >
            <v-icon dark>mdi-pencil</v-icon>
          </v-btn>
          <v-btn
            class="mx-2"
            fab
            small
            @click="hapuskategori(item)"
            style="background: #ff2a30"
          >
            <v-icon dark>mdi-delete</v-icon>
          </v-btn>
        </template>
      </v-data-table>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  middleware: ["middlewareku", "middlewarerole"],
  data() {
    return {
      alluser: {},
      alltoko: {},
      allkategori: [],
      allbarang: {
        toko_id: " ",
      },

      dialogDeleteuser: false,
      dialogDeletebarang: false,
      dialogDeletekategori: false,
      dialogEditkategori: false,
      dialogTambahkategori: false,
      dialogDeletetoko: false,
      editedIndex: 0,
      detaildatadialoguser: {
        id: "",
      },
      detaildatadialogtoko: {
        toko_id: "",
      },
      detaildatadialogbarang: {
        barang_id: "",
      },
      allbarang: {
        barang_id: "",
      },
      headers: [
        { text: "Nama Kategori", value: "nama" },
        { text: "Aksi", value: "aksi" },
      ],
      detaildatadialogkategori: {
        nama: "",
      },
      detaildatadialogkategoritbh: {
        nama: "",
      },
      defaultItem: {
        nama: "",
      },
    };
  },

  methods: {
    getallkategori() {
      axios.get("http://127.0.0.1:8000/api/getallkategori").then((respon) => {
        console.log(respon);
        this.allkategori = respon.data;
      });
    },
    getalluser() {
      axios.get("http://127.0.0.1:8000/api/getalluser").then((respon) => {
        console.log(respon);
        this.alluser = respon.data;
      });
    },
    hapususer(item) {
      this.editedIndex = this.alluser.indexOf(item);
      this.detaildatadialoguser = Object.assign({}, item);
      this.dialogDeleteuser = true;
      console.log(item);
    },
    confirmhapususer() {
      axios
        .delete(
          "http://127.0.0.1:8000/api/deleteuser/" + this.detaildatadialoguser.id
        )
        .then((respon) => {
          console.log(respon);
          alert("berhasil hapus");
        });
      this.alluser.splice(this.editedIndex, 1);
      this.closeDeleteuser();
    },
    closeDeleteuser() {
      this.dialogDeleteuser = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    getalltoko() {
      axios.get("http://127.0.0.1:8000/api/getalltoko").then((respon) => {
        console.log(respon);
        this.alltoko = respon.data;
      });
    },
    hapustoko(item) {
      this.editedIndex = this.alluser.indexOf(item);
      this.detaildatadialogtoko = Object.assign({}, item);
      this.dialogDeletetoko = true;
      console.log(item);
    },
    confirmhapustoko() {
      axios
        .delete(
          "http://127.0.0.1:8000/api/hapustoko/" +
            this.detaildatadialogtoko.toko_id
        )
        .then((respon) => {
          console.log(respon);
          alert("berhasil hapus");
        });
      this.alltoko.splice(this.editedIndex, 1);
      this.closeDeletetoko();
    },
    closeDeletetoko() {
      this.dialogDeletetoko = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    hapusbarang(item) {
      this.editedIndex = this.allbarang.indexOf(item);
      this.detaildatadialogbarang = Object.assign({}, item);
      this.dialogDeletebarang = true;
      console.log(item);
    },
    confirmhapusbarang() {
      axios
        .delete(
          "http://127.0.0.1:8000/api/deletebarang/" +
            this.detaildatadialogbarang.barang_id
        )
        .then((respon) => {
          console.log(respon);
          alert("berhasil hapus");
        });
      this.allbarang.splice(this.editedIndex, 1);
      this.closeDeletebarang();
    },
    closeDeletebarang() {
      this.dialogDeletebarang = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    getallbarang() {
      axios.get("http://127.0.0.1:8000/api/getallbarangtoko").then((respon) => {
        this.allbarang = respon.data;
      });
    },

    closetambahkategori() {
      this.dialogTambahkategori = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
    tambahkategori() {
      this.dialogTambahkategori = true;
    },
    confirimtambahkategori() {
      axios
        .post(
          "http://127.0.0.1:8000/api/createkategori",
          this.detaildatadialogkategoritbh
        )
        .then((respon) => {
          console.log(respon.data);
          location.reload();
        });
      this.dialogTambahkategori = false;
    },
    ubahkategori(item) {
      this.indexnya = this.allkategori.indexOf(item);
      this.detaildatadialogkategori = Object.assign({}, item);
      this.dialogEditkategori = true;
    },
    closeedit() {
      this.$nextTick(() => {
        this.detaildatadialogkategori = Object.assign({}, this.defaultItem);
      });
      this.dialogEditkategori = false;
    },
    updatekategori() {
      axios
        .post(
          "http://127.0.0.1:8000/api/updatekategori/" +
            this.detaildatadialogkategori.kategori_id,
          this.detaildatadialogkategori
        )
        .then((respon) => {
          console.log(respon.data);
          location.reload();
        });
      // Object.assign(this.allkategori[this.indexnya], this.detaildatadialogkategori)
      this.dialogEditkategori = false;
    },

    hapuskategori(item) {
      this.editedIndex = this.allkategori.indexOf(item);
      this.detaildatadialogkategori = Object.assign({}, item);
      this.dialogDeletekategori = true;
    },
    confirmhapuskategori() {
      axios
        .delete(
          "http://127.0.0.1:8000/api/deletekategori/" +
            this.detaildatadialogkategori.kategori_id
        )
        .then((respon) => {
          console.log(respon);
          alert("berhasil hapus");
          location.reload();
        });
      this.closeDeletekategori();
    },
    closeDeletekategori() {
      this.dialogDeletekategori = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
  },

  created() {
    this.getalluser();
    this.getalltoko();
    this.getallbarang();
    this.getallkategori();
  },
};
</script>

<style>
.items {
  display: flex;
}
.contact {
  background-color: #2f432d;
  padding: 5px 0px 7px 154px;
}
.home-container {
  padding: 0px 123px;
}
.sub-title {
  font-family: "Poppins", sans-serif;
  font-weight: 700;
  font-size: 24px;
}
.menu {
  font-family: "Poppins", sans-serif;
  font-weight: 500;
  font-size: 20px;
}
.logout {
  margin-top: 100px;
  font-family: "Poppins", sans-serif;
  font-weight: 500;

  font-size: 20px;
}
</style>