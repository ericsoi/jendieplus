#!/usr/bin/python3
import imageio as iio
 
# read an image
img = iio.imread("logbook-_-2Logbook.jpeg")
ctx = iio.LocalContext(img)
print(ctx)
# write it in a new format
# iio.imwrite("g4g.jpg", img)