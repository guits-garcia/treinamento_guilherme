        console.log(document.getElementById("mapContent"))
        const platform = new H.service.Platform({
            'apikey': "cLZTHOOjxwvFQOGFqS5PzCXA5DE47wCXYN3w3sQdcuU"
        });

        var defaultLayers = platform.createDefaultLayers();

        const map = new H.Map(
            document.getElementById('mapContent'),
            defaultLayers.vector.normal.map,  //tem que mudar entre vector e raster
            { //vector.normal
                zoom:16,
                center: { lat: -27.632371, lng: -52.2752677 }
            }
        );
        const marker1 = new H.map.Marker({ lat: -27.632371, lng: -52.2752677 });
        map.addObject(marker1);