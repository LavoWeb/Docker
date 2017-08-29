for file in `find . -type f -name Dockerfile -print 2>/dev/null`
do
    docker build `dirname $file`
done
