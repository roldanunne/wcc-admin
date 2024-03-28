    /*
     * AngularJS Module
     */
    var appModule = angular.module('appModule', [
        'ngSanitize',
        'ngStorage',
        'ui.bootstrap'
    ]).constant("CSRF_TOKEN", '{{ csrf_token() }}');

    appModule.filter('trusted', function($sce){
        return function(html){
            return $sce.trustAsHtml(html)
        }
    })
     
    $(document).on('change', '.browse', function() {
        if (this.files.length === 0) return;
        if (this.files[0].type.match(/image\/*/) == null) {
            SwalError('Only images are supported!');
            $('.modal').modal('hide');
            return;
        }
        var photoid = $(this).attr('photoid');
        $('.' + photoid).text(this.files[0].name);
        var reader = new FileReader();
        reader.readAsDataURL(this.files[0]);
        reader.onload = function() { $('#' + photoid).attr('src', reader.result); }
    });

    $(document).on('keyup paste', '.limit-300', function() {
        var ctr = $(this).val().replace(/(<([^>]+)>)/ig, "").length;
        $(this).parent().find('.limit-300-counter').text((300 - ctr) + ' characters remaining.');
    });

    function SwalSuccess(text) {
        hideLoader();
        Swal.fire({
            title: 'Success!',
            text: text,
            icon: 'success',
            confirmButtonColor: '#3b5de7',
            timer: 5000
        });
    };

    function SwalError(text) {
        hideLoader();
        Swal.fire({
            title: 'Error!',
            text: text,
            icon: 'error',
            confirmButtonColor: '#3b5de7',
            timer: 5000
        });
    };

    function SwalWarning(text) {
        hideLoader();
        Swal.fire({
            title: 'Warning!',
            text: text,
            icon: 'warning',
            confirmButtonColor: '#3b5de7',
            timer: 5000
        });
    };

    function SwalInfo(text) {
        hideLoader();
        Swal.fire({
            title: 'Info!',
            text: text,
            icon: 'info',
            confirmButtonColor: '#3b5de7',
            timer: 5000
        });
    };

    function SwalQuestion(text) {
        hideLoader();
        Swal.fire({
            title: 'Are you Sure?!',
            text: text,
            icon: 'question',
            confirmButtonColor: '#3b5de7',
            timer: 5000
        });
    };

    function SwalAlert(title, text, icon = 'success', timer = 5000) {
        hideLoader();
        Swal.fire({
            title: title,
            text: text,
            icon: icon,
            confirmButtonColor: '#3b5de7',
            timer: timer
        });
    };

    function SwalErrorNetwork() {
        hideLoader();
        Swal.fire({
            title: 'Opps! something wents wrong',
            text: 'Sorry, your request cannot not be process. Please try again!',
            icon: 'error',
            confirmButtonColor: '#3b5de7',
            timer: 5000
        });
    };

    $(document).on('focusout', '.form-control', function() {
        if ($(this).hasClass('ng-invalid')) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });

    function slashEmptyObj(jsonObj) {
        $.each(jsonObj, function(key, value) {
            if (value === "" || value === null) {
                delete jsonObj[key];
            }
        });
        return jsonObj;
    };
    
    function toPercentSign(e) {
        return (Math.round((e * 100) * 100) / 100) + "%";
    }
    
    function isInteger(e) {
        e = (e) ? e : window.event;
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    
    function isFloat(e) {           
        var charCode;
        if (e.keyCode > 0) {
            charCode = e.which || e.keyCode;
        }
        else if (typeof (e.charCode) != "undefined") {
            charCode = e.which || e.keyCode;
        }
        if (charCode == 46)
            return true
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    //Full Image View JS
    $(document).on('click', '.full-view-image', function() {
        $('.full-view-modal').css('display', 'block');
        var src = $(this).attr("src");
        var fn1 = src.replace(/^.*[\\\/]/, '');
        var fn2 = fn1.indexOf('_') == 0 ? fn1.substring(1) : fn1;
        src = src.replace(fn1, fn2);
        $('.full-view-modal-content').attr("src", src);
        $('.full-view-caption').text($(this).attr("alt"));
    });
    $(document).on('click', '.full-view-modal', function() {
        $(this).css('display','none');
    });

    function getBasename(src) {
        return src.replace(/^.*[\\\/]/, '');
    }

    //Download File JS
    function downloadFile(url) {         
        var element = document.createElement('a'); 
        element.setAttribute('href', url); 
        element.setAttribute('download',''); 
        document.body.appendChild(element); 
        element.click(); 
        document.body.removeChild(element); 
    }
    
    //Preloader
    function showLoader() {
        $('.pre-overlay').css('display', 'block');
    } 
    function hideLoader() {
        $('.pre-overlay').css('display', 'none');
    }

    //Auto active menu on sidebar
    $(".sidebar-menu").each(function() {
        var tempUrl = window.location.pathname.split("/");
        var pageUrl = window.location.protocol + "//" + window.location.host + "/" + tempUrl[1];
        if (this.href == pageUrl) {
            $(this).addClass("active");
            $(this).parent().parent().attr("menu-active", this.id);
        } else {
            pageUrl = window.location.protocol + "//" + window.location.host + "/" + tempUrl[1]+ "/" + tempUrl[2];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().parent().attr("menu-active", this.id);
            }
        }
    });



    // Adds a marker to the map and push to the array.
    function addMarker(map, markers, location, title, icon) {
        var marker = new google.maps.Marker({
            position: location,
            title: title,
            icon: {
                url: baseURL + '/images/'+icon,
                scaledSize : new google.maps.Size(40, 40),
            },
            map: map
        });
        markers.push(marker);
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map, markers) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    // Removes the markers from the map, but keeps them in the array.
    function clearMarkers(markers) {
        setMapOnAll(null, markers);
    }

    // Shows any markers currently in the array.
    function showMarkers(map, markers) {
        setMapOnAll(map, markers);
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers(markers) {
        clearMarkers(markers);
        markers = [];
    }

    
    function validateMobile(mobile) {
        var re = /^(09)\d{9}$/gm;
        return re.test(mobile);
    };
    
    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    };