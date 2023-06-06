package main

import (
	"C"

	"bytes"

	"github.com/yuin/goldmark"
)

//export ParseMarkdown
func ParseMarkdown(text_ *C.char) *C.char {
	text := C.GoString(text_)

	source := []byte(text)

	var buf bytes.Buffer

	if err := goldmark.Convert(source, &buf); err != nil {
		panic(err)
	}

	return C.CString(buf.String())
}

func main() {

}
