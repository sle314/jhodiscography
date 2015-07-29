import os, shutil
for root, dir, file in os.walk("."):
	if not os.listdir(root):
		print root