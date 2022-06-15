async function callApi(url, params = null, method = "POST", token = false) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    return new Promise((resolve, reject) => {
        $.ajax({
            url: url,
            type: method,
            data: params,
            beforeSend: function (xhr) {
                if (token) {
                    xhr.setRequestHeader("Authorization", token);
                }
            },
            success: function (data) {
                resolve(data);
            },
            error: function (error) {
                // console.log("ERROR:", error);
                reject(error);
            },
        });
    });
}
