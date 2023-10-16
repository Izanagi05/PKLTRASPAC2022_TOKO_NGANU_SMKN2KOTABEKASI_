import axios from 'axios'
export const state = () => ({
  alldatabarang: [],
  // editedIndex: -1
  response:null

})

export const mutations= {
  GET_DATA(state, parsdata){
    state.alldatabarang=parsdata
    // console.log(parsdata)
  },
  CREATE_DATA(state, adddata){
    state.alldatabarang.push(adddata)
    // console.log(parsdata)
  },
  UPDATE_DATA(state, updtdata){
    const index = state.alldatabarang.findIndex(item => item.varian_id === parseInt(updtdata.varian_id));
    // const index = state.alldatabarang.findIndex(item => item.varian_id === updtdata.varian_id);
    if (index !== -1) {
    // console.log(parsdata)
    const datasementara= state.alldatabarang

    datasementara[index]= updtdata
    state.alldatabarang=[...datasementara]
  }
  console.log(updtdata.varian_id);
  },
  DELETE_DATA(state, id){

    const index = state.alldatabarang.findIndex(item => item.varian_id === id);

    if (index !== -1) {
      // Hapus item dari array
      state.alldatabarang.splice(index, 1);
    }

  }

}
export const getters = {
  getdata: (state)=> state.alldatabarang,
  getresp: (state)=> state.response

}

export const actions ={
  async getdatavarian({commit}, paramId){
    axios
    .get("http://127.0.0.1:8000/api/getvarianbarang/" + paramId)
    .then((respon) => {
      commit('GET_DATA', respon.data?.data)
      // this.barang = respon.data?.data;
    });
  },
  async tambahdata({commit}, newData){
    const formData = new FormData();
    formData.append("nama", newData.nama);
    formData.append("harga", newData.harga);
    formData.append("stok", newData.stok);
    formData.append(
      "foto_barang_varian",
      newData.foto_barang_varian
    );
    axios
      .post(
        "http://127.0.0.1:8000/api/createvarianbarang/" + newData.idbrg,
        formData,
        {
          "content-type": "multipart/form-data",
        }
      )
      .then((respon) => {
        commit('CREATE_DATA', respon.data?.data)
        console.log(respon);
        // this.$store.dispatch('getdatavarian', newData.idbrg);
        // this.barang.push(this.detaildatadialog)
        // this.getvarian();
      });
  },
  async ubahdata({commit}, updatedata){
    const formData = new FormData();
    formData.append("nama", updatedata.nama);
    formData.append("harga", updatedata.harga);
    formData.append("stok", updatedata.stok);
    if (updatedata.fotosementara) {
      formData.append("foto_barang_varian", updatedata.fotosementara);
    } else {
      formData.append(
        "foto_barang_varian",
        updatedata.foto_barang_varian
      );
    }
    axios
      .post(
        "http://127.0.0.1:8000/api/updatevarianbarang/" +
          updatedata.varian_id,
        formData,
        {
          "content-type": "multipart/form-data",
        }
      )
      .then((respon) => {
        commit('UPDATE_DATA', respon.data?.data)

        // this.getvarian();
        this.$toast.success("Berhasil update");
      });
  },
  async hapusdata({commit}, iddata){
    axios
    .delete(
      "http://127.0.0.1:8000/api/deletevarianbarang/" +
      iddata
      )
      .then((respon) => {
      commit('DELETE_DATA', iddata)
      console.log(respon);
      // this.getvarian();
      // this.barang
      this.$toast.success("Berhasil hapus");
    });
  }
}


