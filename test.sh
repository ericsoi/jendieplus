#!/bin/sh
echo "Options:(enter one)\n1. Update domain\n2. Dissable Domain"
read option
if [ $option == 1 ]; then
    echo "read domain"
    read domain
    echo "read file"
    read file
    cp $file 
    sed -i "s/example.com/$domain/" $file
elif [ $option == 2 ]; then
    sed -i '' -e '24,26 s/^/#/' $file
else
    echo "Invalid Sellection"
fi