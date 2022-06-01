from flask import Flask, render_template, url_for, request, jsonify
import numpy as np

from sklearn import metrics
import pandas as pd
import tensorflow as tf
import sys
import os
from tensorflow.python.framework import ops
ops.reset_default_graph()


# Disable tensorflow compilation warnings
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '2'


app = Flask(__name__)


@app.route("/image")
def image():
    # Read the image_data
    tf.reset_default_graph()
    image_path = "uploads/testimage.jpg"
    print("Image Path", image_path)

    image_data = tf.gfile.FastGFile(image_path, 'rb').read()
    print("Test 1" )
    # Loads label file, strips off carriage return sftp://ubuntu@3.133.36.22/opt/lampp/htdocs/tf_files/retrained_graph.pb
    label_lines = [line.rstrip() for line
                   in tf.gfile.GFile("tf_files/retrained_labels.txt")]
    print("Test 2" )

    with tf.gfile.FastGFile("tf_files/retrained_graph.pb", 'rb') as f:
        print("Test 3" )

        graph_def = tf.GraphDef()
        graph_def.ParseFromString(f.read())
        _ = tf.import_graph_def(graph_def, name='')

    with tf.Session() as sess:
        print("Test 4" )

        softmax_tensor = sess.graph.get_tensor_by_name('final_result:0')

        predictions = sess.run(softmax_tensor,
                               {'DecodeJpeg/contents:0': image_data})

        top_in_tree = predictions[0].argsort()[-len(predictions[0]):][::-1]

        for root_node_id in top_in_tree:
            print("Test 5" )

            print(root_node_id)
            tree_string = label_lines[root_node_id]
            score = predictions[0][root_node_id]
            print('%s (score = %.5f)' % (tree_string, score))

    label0 = label_lines[0]
    label1 = label_lines[1]
    score0 = str(predictions[0][0])
    score1 = str(predictions[0][1])

    print("Testr Score", score1)

    return jsonify({label0: score0, label1: score1})


if __name__ == "__main__":
    app.debug = True
    app.run(host="0.0.0.0", port=5000)
