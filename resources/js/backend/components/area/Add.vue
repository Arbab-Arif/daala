<template>
    <div class="content">
        <div class="intro-y flex items-center mt-8">
            <h2 class="text-lg font-medium mr-auto">
                Create Area
            </h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="p-5" id="form-validation">
                        <div class="preview">
                            <div class="flex flex-wrap -mx-3 mb-2">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                        Name
                                    </label>
                                    <input type="text" name="name" id="name" v-model="data.name"
                                           class="cols-3 input w-full border mt-2" placeholder="Enter Name"
                                           minlength="2">
                                </div>
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0 text-right mt-8">
                                    <button class="button bg-red-600 text-white" @click="clearMap()">Clear Map</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box">
                    <div class="p-5">
                        <div class="preview">
                            <div id="map"></div>
                            <button @click="submit"  v-text="submitting ? 'Submitting...' : 'Submit'" class=" button bg-theme-1 text-white mt-5">
                                Submit
                            </button>
                            <a href="/admin/area">
                                <button class="button bg-red-600 text-white">Cancel</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            data: {
                name: '',
                bounds: [],
                status: 0
            },
            submitting: false,
            layer_bounds: [],
            drawingManager: null,
            arr: [],
            oldPolygon: [],
            oldLatLng: [],
            selectedShape: 'polygon',
            polygon: null
        }
    },

    mounted() {
        this.$nextTick(() => {
            this.map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(24.8607, 67.0011),
                zoom: 9,
            });

            this.setUpMap();

        });
    },
    methods: {
        setUpMap: function () {
            this.drawingManager = this.getDrawingManager();
            this.drawingManager.setMap(this.map);

            google.maps.event.addListener(this.drawingManager, 'overlaycomplete', this.overLayComplete);

            for (const value of this.data.bounds) {
                this.oldPolygon.push(new google.maps.LatLng(value.lat, value.lng));
                this.oldLatLng.push(new google.maps.LatLng(value.lat, value.lng));
            }
            this.setUpPolygon();
        },
        getDrawingManager: function () {
            return new google.maps.drawing.DrawingManager({
                drawingMode: google.maps.drawing.OverlayType.POLYGON,
                drawingControl: true,
                drawingControlOptions: {
                    position: google.maps.ControlPosition.TOP_CENTER,
                    drawingModes: [google.maps.drawing.OverlayType.POLYGON]
                },
                polygonOptions: {
                    editable: true,
                    draggable: true,
                    fillColor: '#ff0000',
                    strokeColor: '#ff0000',
                    strokeWeight: 1
                }
            })
        },
        clearMap: function () {
            if (this.data.bounds.length === 0) return false;
            this.drawingManager.setMap(this.map);
            this.polygon.setMap(null);
            this.deleteSelectedShape();
            this.data.bounds = [];
            this.setUpMap();
        },
        setUpPolygon: function () {
            this.polygon = new google.maps.Polygon({
                path: this.oldPolygon,
                strokeColor: "#ff0000",
                strokeOpacity: 0.8,
                fillColor: "#ff0000",
                fillOpacity: 0.3,
                editable: true,
                draggable: true,
            });

            this.polygon.setMap(this.map);
        },
        deleteSelectedShape: function () {
            if (this.selectedShape) {
                this.data.bounds = [];
                this.selectedShape.setMap(null);
            }
        },
        overLayComplete: function (e) {
            this.data.bounds = [];
            this.layer_bounds = [];
            let newShape = e.overlay;
            if (e.type == google.maps.drawing.OverlayType.POLYGON) {
                let locations = e.overlay.getPath().getArray();
                this.arr.push(e);
                let markerLat = null;
                let markerLng = null;
                for (const location of locations) {
                    markerLat = (location.lat()).toFixed(6);
                    markerLng = (location.lng()).toFixed(6);
                    this.layer_bounds.push(new google.maps.LatLng(markerLat, markerLng));
                    this.data.bounds.push({
                        'lat': markerLat,
                        'lng': markerLng
                    });
                }
                this.overlayClickListener(e.overlay);
                this.drawingManager.setOptions({drawingMode: null, drawingControl: false});
                this.setSelection(newShape);
            }
        },
        setSelection: function (shape) {
            if (shape.type === 'polygon') {
                clearSelection();
                shape.setEditable(true);
            }
            this.selectedShape = shape;
        },
        overlayClickListener: function (overlay) {
            google.maps.event.addListener(overlay, "mouseup", () => this.overlayMouseUp(overlay));
        },
        overlayMouseUp: function (overlay) {
            this.data.bounds = [];
            let locations = overlay.getPath().getArray();
            let locLat = null;
            let locLng = null;
            for (const location of locations) {
                locLat = (location.lat()).toFixed(6);
                locLng = (location.lng()).toFixed(6);
                this.data.bounds.push({
                    'lat': locLat,
                    'lng': locLng
                });
            }
        },
        submit: function () {
            for (let input in this.data) {
                if (this.data[input] === '') {
                    this.$alertify.error(`${input} is required`);
                    return false;
                }
            }
            this.submitting = true
            axios.post('/admin/area', this.data)
                .then(() => {
                    this.$alertify.success("Area Created Successfully!");
                    setTimeout(() => {
                        window.location.href = '/admin/area';
                    }, 1000)
                })
                .catch(err => {
                    this.submitting = false
                    if (err.response.status === 422) {
                        let errors = Object.values(err.response.data.errors);
                        for (let error of errors) {
                            this.$alertify.error(error[0]);
                        }
                    }
                })
        }
    }
}
</script>
<style>
#map {
    height: 300px!important;
    margin: 0;
    padding: 0;
}
</style>
