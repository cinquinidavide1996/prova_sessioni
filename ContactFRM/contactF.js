
function TASasync() {
    return new Promise(function (resolve) {
        $.ajax({
            url: 'functionPHP.php',
            method: 'POST',
            dataType: 'json',
            data: dtc,
            success: function (data) {
                resolve(data);
            }
        });
    });
}

function TASsync() {
    var r;

    $.ajax({
        url: 'functionPHP.php',
        method: 'POST',
        dataType: 'json',
        data: dtc,
        async: false,
        success: function (data) {
            r = data.result;
        }
    });

    return r;
}

class Contact {
    constructor(f) {
        this.filename = f.url;
        this.sync = f.async;
    }

    ready(f) {
        var sync = {};
        var async = {};
        var controlSync = this.sync;

        $.ajax({
            method: 'POST',
            url: this.filename,
            dataType: "json",
            data: {
                function: 'getMethod'
            },
            success: function (r) {
                $.each(r, function (k, v) {
                    var txt = "{";
                    $.each(v, function (k1, v1) {
                        txt += k1 + ": " + v1 + ",";
                    });
                    txt += "function: '" + k + "'";
                    txt += "}";

                    var func = TASasync.toString().replace('dtc', txt);
                    func = func.slice(func.indexOf("{") + 1, func.lastIndexOf("}"));
                    async[k] = new Function(v.join(','), func);

                    var func = TASsync.toString().replace('dtc', txt);
                    func = func.slice(func.indexOf("{") + 1, func.lastIndexOf("}"));
                    sync[k] = new Function(v.join(','), func);


                    if (controlSync) {
                        window[k] = sync[k];
                    } else {
                        window[k] = async[k];
                    }

                });
                f(sync, async);
            }
        });
    }
}
