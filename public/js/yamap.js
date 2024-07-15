// Yandex Map
let yandexMapInit = function () {
    let center = [55.776534451190315, 37.54337849781465];


    function init() {
        let mapIst = new ymaps.Map('map-yandex', {
            center: center,
            zoom: 17,
            controls: []
        });


        let placemark1 = new ymaps.Placemark([55.776534451190315, 37.54337849781465], {
            balloonContent: 
            `
                <div class="balloon">          
                <div class="baloon__content">               
                
                <img class="map_baloon" src="../img/baloon.png">                            
                
                </div>
                `
            },
            {
                iconLayout: 'default#image',
                iconImageSize: [40, 40],
                iconImageOffset: [-19, -44]
            });


        mapIst.controls.remove('geolocationControl');
        mapIst.controls.remove('searchControl');
        mapIst.controls.remove('trafficControl');
        mapIst.controls.remove('typeSelector');
        mapIst.controls.remove('fullscreenControl');
        mapIst.controls.remove('zoomControl');
        mapIst.controls.remove('rulerControl');
        mapIst.options.set({balloonPanelMaxMapArea: '30%'});
        mapIst.geoObjects.add(placemark1);
        placemark1.balloon.open();
    }

    ymaps.ready(init);
}

yandexMapInit();

// `
//                 <div class="balloon">          
//                 <div class="baloon__content">
//                 <span>Niktea</span>
//                 <div class="balloon__address">Хорошeвское ш.32А, <br>офис 109</div>
//                 <img class="map_stars" src="/local/templates/isttrade/img/stars.png">            
//                 </div>              
//                 <img class="map_logo" src="/local/templates/isttrade/img/map_logo.png"></div>          
//                 </div>
//                 `