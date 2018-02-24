<template>
    <div v-on:dblclick="changeMode">
        <div v-if="!changeStatus">
            {{displayValue}}
        </div>
        <SuperInput v-else ref="input" :value="displayValue" @blur="updateValue" />
    </div>
</template>
<script>
import axios from "axios";
import SuperInput from "./SuperInput";
import math from "mathjs";

export default {
  data: function() {
    return {
      changeStatus: false,
      displayValue: ""
    };
  },
  components: {
    SuperInput: SuperInput
  },
  props: {
    value: {
      type: String
    },
    type: {
      type: String
    },
    del: {
      type: String
    },
    token: {
      type: String
    },
    update_url: {
      type: String
    },
    size: {
      type: Number
    },
    pq_id: {
      type: Number
    }
  },
  updated: function() {
    if (this.changeStatus) {
      this.$refs.input.focus();
    }
  },
  created: function() {
    this.displayValue = this.value;
    this.defaultValue = this.value;
  },
  methods: {
    changeMode: function() {
      this.changeStatus = true;
    },
    updateValue: function(value) {
      this.changeStatus = false;
      this.displayValue = value;
      const that = this;
      axios
        .post(this.update_url, {
          value: value,
          type: this.type,
          pq_id: this.pq_id
        })
        .then(function(res) {
          that.defaultValue = value;
        })
        .catch(function() {
          that.displayValue = that.defaultValue;
        });
    }
  }
};
</script>