navigator.usb.getDevices()
    .then(devices => {
        console.log("Total devices: " + devices.length);
        devices.forEach(device => {
            console.log("Product name: " + device.productName + ", serial number " + device.serialNumber);
        });
    });