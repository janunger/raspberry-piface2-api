import pifacedigitalio as piface

piface.init()

list = []
for i in range(0, 7):
    list.append(str(piface.digital_read(i)))

result = ''.join(list)
print(result)
