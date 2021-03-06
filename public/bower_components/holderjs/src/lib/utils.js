/**
 * Shallow object clone and merge
 *
 * @param a Object A
 * @param b Object B
 * @returns {Object} New object with all of A's properties, and all of B's properties, overwriting A's properties
 */
exports.extend = function(a, b) {
    var c = {};
    for (var x in a) {
        if (a.hasOwnProperty(x)) {
            c[x] = a[x];
        }
    }
    if (b != null) {
        for (var y in b) {
            if (b.hasOwnProperty(y)) {
                c[y] = b[y];
            }
        }
    }
    return c;
};

/**
 * Takes a k/v list of CSS properties and returns a rule
 *
 * @param props CSS properties object
 */
exports.cssProps = function(props) {
    var ret = [];
    for (var p in props) {
        if (props.hasOwnProperty(p)) {
            ret.push(p + ':' + props[p]);
        }
    }
    return ret.join(';');
};

/**
 * Encodes HTML entities in a string
 *
 * @param str Input string
 */
exports.encodeHtmlEntity = function(str) {
    var buf = [];
    var charCode = 0;
    for (var i = str.length - 1; i >= 0; i--) {
        charCode = str.charCodeAt(i);
        if (charCode > 128) {
            buf.unshift(['&#', charCode, ';'].join(''));
        } else {
            buf.unshift(str[i]);
        }
    }
    return buf.join('');
};

/**
 * Checks if an image exists
 *
 * @param src URL of image
 * @param callback Callback to call once image status has been found
 */
exports.imageExists = function(src, callback) {
    var image = new Image();
    image.onerror = function() {
        callback.call(this, false);
    };
    image.onload = function() {
        callback.call(this, true);
    };
    image.src = src;
};

/**
 * Decodes HTML entities in a string
 *
 * @param str Input string
 */
exports.decodeHtmlEntity = function(str) {
    return str.replace(/&#(\d+);/g, function(match, dec) {
        return String.fromCharCode(dec);
    });
};


/**
 * Returns an element's dimensions if it's visible, `false` otherwise.
 *
 * @param el DOM element
 */
exports.dimensionCheck = function(el) {
    var dimensions = {
        height: el.clientHeight,
        width: el.clientWidth
    };

    if (dimensions.height && dimensions.width) {
        return dimensions;
    } else {
        return false;
    }
};


/**
 * Returns true if value is truthy or if it is "semantically truthy"
 * @param val
 */
exports.truthy = function(val) {
    if (typeof val === 'string') {
        return val === 'true' || val === 'yes' || val === '1' || val === 'on' || val === '???';
    }
    return !!val;
};
