#!/bin/bash

ln -s Common/ target
if [ -d target ]; then
	echo "Common exists"
	echo "cd Common"
	cd Common
	ls -a
	echo "$(which git) pull"
	$(which git) pull
	cd ..
else
	echo "git clone https://github.com/csmu-cenr/Common"
	git clone https://github.com/csmu-cenr/Common
fi
rm target

echo "mkdir -p samples/results/"
mkdir -p samples/results/

echo "cd samples"
cd samples

echo "$(which php) Sample_05_Chart_Line_Single.php"
$(which php) Sample_05_Chart_Line_Single.php

echo "cp Sample_05_Chart_Line_Single_Target.pptx results/."
cp Sample_05_Chart_Line_Single_Target.pptx results/.

echo "cd results/"
cd results

echo "ls Sample_05_Chart_Line_Single*"
ls Sample_05_Chart_Line_Single*




