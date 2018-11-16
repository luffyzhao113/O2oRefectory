import Storage from 'web-storage-cache'

const storageCahce = new Storage({
  storage: 'localStorage'
});

var _newKeyAsString = function (key) {
    if (typeof key !== 'string') {
        console.warn(key + ' used as a key, but it is not a string.');
        key = String(key);
    }
    return key + ':' + SELLER_ID;
}

const cache = {
    set: function (key, value, options) {
        return storageCahce.set(_newKeyAsString(key), value, options);
    },
    get: function (key) {
        return storageCahce.get(_newKeyAsString(key));
    },

    delete: function (key) {
        return storageCahce.delete(_newKeyAsString(key));
    },
    add: function (key, options) {
        return storageCahce.add(_newKeyAsString(key, options));
    },
    replace: function (key, value, options) {
        return storageCahce.replace(_newKeyAsString(key, value, options));
    },
    touch: function (key, exp) {
        return storageCahce.touch(_newKeyAsString(key, exp));
    }
};

export default {
  install (Vue) {
    Vue.prototype.$cache = cache
    Vue.cache = cache
  },
  $cache: cache
}



export const $cache = cache