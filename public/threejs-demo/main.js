var scene, camera, renderer, cube;
var _width = 2, _height = 2, _depth = 2;
var color="blue";
var colorImage = 'https://i.postimg.cc/fJpcmbvj/chocolat-brown.jpg';
var wireframe = false;
var fovMAX = 100;
var fovMIN = 1;

var WIDTH  = window.innerWidth / 2;
var HEIGHT = window.innerHeight / 2;
const PIXEL_CENTIMET = 1;

var SPEED = 0.01;

init();
render();

function init() {
    scene = new THREE.Scene();
    //scene.background = new THREE.Color('#FBF7F6');
    initCamera();
    initRenderer();
	initCube();
		
    document.getElementById('container').appendChild(renderer.domElement);
	addMouseHandler(document.getElementsByTagName("canvas")[0]);

    document.addEventListener( 'mousewheel', (event) => {
      camera.fov -= event.wheelDeltaY * 0.05;
      camera.fov = Math.max(Math.min(camera.fov, fovMAX), fovMIN);
      camera.updateProjectionMatrix();
    });
}

function onDocumentMouseWheel() {
    fov -= event.wheelDeltaY * 0.05;
    camera.projectionMatrix = THREE.Matrix4.makePerspective( fov, window.innerWidth / window.innerHeight, 1, 1100 );
}

function render() {
  requestAnimationFrame(render);
  //rotateCube();
  renderer.render(scene, camera);
}

function initCamera() {
    camera = new THREE.PerspectiveCamera(fovMAX, WIDTH / HEIGHT, 1, 10);
    camera.position.set(0, 3.5, 5);
    camera.lookAt(scene.position);
}

function initRenderer() {
    renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(WIDTH, HEIGHT);
}

function initCube() {
	drawCube();
}
function drawCube() {	
	const texture = new THREE.TextureLoader().load( colorImage );
	var geometry = new THREE.CubeGeometry(_width, _height, _depth);
	var cubeMaterials = [ 
		new THREE.MeshBasicMaterial({map : texture, transparent:false, opacity:0.8, side: THREE.DoubleSide}),
		new THREE.MeshBasicMaterial({map : texture, transparent:false, opacity:0.8, side: THREE.DoubleSide}), 
		new THREE.MeshBasicMaterial({map : texture, transparent:true, opacity:0.1, side: THREE.DoubleSide}),
		new THREE.MeshBasicMaterial({map : texture, transparent:false, opacity:0.8, side: THREE.DoubleSide}), 
		new THREE.MeshBasicMaterial({map : texture, transparent:false, opacity:0.8, side: THREE.DoubleSide}), 
		new THREE.MeshBasicMaterial({map : texture, transparent:false, opacity:0.8, side: THREE.DoubleSide}), 
	]; 
	// Create a MeshFaceMaterial, which allows the cube to have different materials on each face 
	var cubeMaterial = new THREE.MeshFaceMaterial(cubeMaterials); 
	cube = new THREE.Mesh(geometry, cubeMaterial);
	
	// wireframe
	var geo = new THREE.EdgesGeometry( cube.geometry );
	var mat = new THREE.LineBasicMaterial( { map : texture, linewidth: 10 } );
	var wireframe = new THREE.LineSegments( geo, mat );
	wireframe.renderOrder = 4; // make sure wireframes are rendered 2nd
	//cube.add( wireframe );
	
	scene.add( cube );
}

function rotateCube() {
    cube.rotation.x -= SPEED * 2;
    cube.rotation.y -= SPEED;
    cube.rotation.z -= SPEED * 3;
}

var mouseDown = false,
        mouseX = 0,
        mouseY = 0;

function onMouseMove(evt) {
	if (!mouseDown) {
		return;
	}

	evt.preventDefault();

	var deltaX = evt.clientX - mouseX,
		deltaY = evt.clientY - mouseY;
	mouseX = evt.clientX;
	mouseY = evt.clientY;
	rotateScene(deltaX, deltaY);
}

function rotateScene(deltaX, deltaY) {
	cube.rotation.y += deltaX / 100;
    cube.rotation.x += deltaY / 100;
}

function onMouseDown(evt) {
	evt.preventDefault();

	mouseDown = true;
	mouseX = evt.clientX;
	mouseY = evt.clientY;
}

function onMouseUp(evt) {
	evt.preventDefault();

	mouseDown = false;
}

function addMouseHandler(canvas) {
	canvas.addEventListener('mousemove', function (e) {
		console.log('sss');
		onMouseMove(e);
	}, false);
	canvas.addEventListener('mousedown', function (e) {
		onMouseDown(e);
	}, false);
	canvas.addEventListener('mouseup', function (e) {
		onMouseUp(e);
	}, false);
}

function changeColor(cl) {
	//colorImage = cl;
	if (cl == 'chocolat_brown.jpg') {
		colorImage = 'https://i.postimg.cc/fJpcmbvj/chocolat-brown.jpg';
	}
	if (cl == 'milk_tea_brown.jpg') {
		colorImage = 'https://i.postimg.cc/jWry3kmD/milk-tea-brown.jpg';
	}
	if (cl == 'mustard_yellow.jpg') {
		colorImage = 'https://i.postimg.cc/NKX14wJh/mustard-yellow.jpg';
	}

    changeStyle();
}
function changeWidth() {
	_width =  $( "#width" ).val() * PIXEL_CENTIMET;
}
function changeHeight() {
	_height = $( "#height" ).val() * PIXEL_CENTIMET;
}
function changeDepth() {
	_depth = $( "#depth" ).val() * PIXEL_CENTIMET;
}

function changeWireframe(wf) {
	wireframe = wf;
}

function changeStyle() {
    changeWidth();
    changeHeight();
    changeDepth();
	scene.remove(cube);
	drawCube();
}